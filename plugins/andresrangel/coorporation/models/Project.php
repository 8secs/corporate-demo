<?php namespace AndresRangel\Coorporation\Models;

use App;
use Str;
use Html;
use Lang;
use October\Rain\Database\Model as BaseModel;
use Carbon\Carbon;
use DB;

/**
 * Project Model
 */
class Project extends BaseModel
{

    use \October\Rain\Database\Traits\Validation;
    
    /**
     * @var string The database table used by the model.
     */
    public $table = 'andresrangel_coorporation_projects';

    /**
     * @var array Validation rules
     */
    protected $rules = [
        'name' => ['required', 'between:4,255'],
        'slug' => [
            'required',
            'alpha_dash',
            'between:1,255',
            'unique:andresrangel_coorporation_projects'
        ]
    ];

    /**
     * The attributes that should be mutated to dates.
     * @var array
     */
    protected $dates = ['published_at'];

    /**
     * The attributes on which the project list can be ordered
     * @var array
     */
    public static $allowedSortingOptions = array(
        'title asc' => 'Title (ascending)',
        'title desc' => 'Title (descending)',
        'created_at asc' => 'Created (ascending)',
        'created_at desc' => 'Created (descending)',
        'updated_at asc' => 'Updated (ascending)',
        'updated_at desc' => 'Updated (descending)',
        'published_at asc' => 'Published (ascending)',
        'published_at desc' => 'Published (descending)',
        'random' => 'Random'
    );

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [
        'services' => [
            'AndresRangel\coorporation\Models\Service',
            'table' => 'andresrangel_coorporation_pivots',
        ],
        'technologies' => [
            'AndresRangel\coorporation\Models\Technology',
            'table' => 'andresrangel_coorporation_pivots',
        ],
        'project_categories' => [
            'AndresRangel\coorporation\Models\ProjectCategory',
            'table' => 'andresrangel_coorporation_pivots',
        ],
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'picture' => ['System\Models\File'],
    ];
    public $attachMany = [
        'pictures' => ['System\Models\File'],
        'files'    => ['System\Models\File'],
    ];
    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    public function afterDelete()
    {
        if($this->picture) $this->picture->delete();
        if($this->pictures){
            foreach ($this->pictures as $item) {
                $item->delete();
            }
        }
        if($this->files){
            foreach ($this->files as $item) {
                $item->delete();
            }
        }

        if($this->project_categories()) $this->project_categories()->detach();
        if($this->services()) $this->services()->detach();
        if($this->tecnologies()) $this->technologies()->detach();
    }

    public function getServicesOptions()
    {
        return Service::all()->lists('name', 'id');
    }

    public function getTechnologiesOptions()
    {
        return Technology::all()->lists('name', 'id');
    }

    public function getProjectCategoriesOptions(){
        return ProjectCategory::all()->list('name', 'id');
    }

    public function setUrl($pageName, $controller)
    {
        $params = [
            'id' => $this->id,
            'slug' => $this->slug,
        ];

        if (array_key_exists('project_categories', $this->getRelations())) {
            $params['project_category'] = $this->project_categories->count() ? $this->project_categories->first()->slug : null;
        }

        return $this->url = $controller->pageUrl($pageName, $params);
    }

    /**
     * Lists posts for the front end
     * @param  array $options Display options
     * @return self
     */
    public function scopeListFrontEnd($query, $options)
    {
        /*
         * Default options
         */
        extract(array_merge([
            'page'       => 1,
            'perPage'    => 30,
            'sort'       => 'created_at',
            'project_categories' => null,
            'project_category'   => null,
            'search'     => '',
        ], $options));

        $searchableFields = ['name', 'slug', 'description'];

        /*
         * Sorting
         */

        if (!is_array($sort)) {
            $sort = [$sort];
        }

        foreach ($sort as $_sort) {

            if (in_array($_sort, array_keys(self::$allowedSortingOptions))) {
                $parts = explode(' ', $_sort);
                if (count($parts) < 2) {
                    array_push($parts, 'desc');
                }
                list($sortField, $sortDirection) = $parts;
                if ($sortField == 'random') {
                    $sortField = DB::raw('RAND()');
                }
                $query->orderBy($sortField, $sortDirection);
            }
        }

        /*
         * Search
         */
        $search = trim($search);
        if (strlen($search)) {
            $query->searchWhere($search, $searchableFields);
        }

        /*
         * Categories
         */
        if ($project_categories !== null) {
            if (!is_array($project_categories)) $project_categories = [$project_categories];
            $query->whereHas('project_categories', function($q) use ($project_categories) {
                $q->whereIn('id', $project_categories);
            });
        }

        /*
         * Category, including children
         */
        if ($project_category !== null) {
            $project_category = ProjectCategory::find($project_category);

            $project_categories = $project_category->getAllChildrenAndSelf()->lists('id');
            $query->whereHas('project_categories', function($q) use ($project_categories) {
                $q->whereIn('id', $project_categories);
            });
        }

        return $query->paginate($perPage, $page);
    }

    /**
     * Allows filtering for specifc categories
     * @param  Illuminate\Query\Builder  $query      QueryBuilder
     * @param  array                     $project_categories List of category ids
     * @return Illuminate\Query\Builder              QueryBuilder
     */
    public function scopeFilterCategories($query, $project_categories)
    {
        return $query->whereHas('project_categories', function($q) use ($project_categories) {
            $q->whereIn('id', $project_categories);
        });
    }

}