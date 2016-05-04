<?php namespace AndresRangel\Coorporation\Models;



/**
 * Service Model
 */
class Service extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'andresrangel_coorporation_services';

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [
        'projects' => [
            'AndresRangel\coorporation\Models\Project',
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
        if($this->projects()) $this->projects()->detach();
    }

    public function getProjectsOptions()
    {
        return Project::all()->lists('name', 'id');
    }

}