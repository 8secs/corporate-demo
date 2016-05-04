<?php namespace AndresRangel\Coorporation\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Lang;
use Cms\Classes\Page;
use October\Rain\Support\Collection;
use AndresRangel\Coorporation\Models\ProjectCategory;
use AndresRangel\Coorporation\Models\Project as ProjectModel;
use AndresRangel\Coorporation\Models\Service;

class Project extends ComponentBase
{

    public $project;

    public $categoryPage;

    public $relatedProjects;

    public function componentDetails()
    {
        return [
            'name'        => 'andresrangel.coorporation::lang.components.project.name',
            'description' => 'andresrangel.coorporation::lang.components.project.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'maxItems' => [
                'title'             => 'andresrangel.coorporation::lang.labels.maxItems',
                'description'       => 'andresrangel.coorporation::lang.descriptions.maxItems',
                'default'           => 20,
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
            ],
            'slug' => [
                'title'       => 'andresrangel.coorporation::lang.labels.slug',
                'description' => 'andresrangel.coorporation::lang.labels.slug_description',
                'default'     => '{{ :slug }}',
                'type'        => 'string'
            ],
            'projectCategoryPage' => [
                'title'       => 'andresrangel.coorporation::lang.project_category.label',
                'description' => 'andresrangel.coorporation::lang.project_category.description',
                'type'        => 'dropdown',
                'default'     => 'portfolio/category',
            ],
            'orderBy'  => [
                'title'       => 'andresrangel.coorporation::lang.labels.orderBy',
                'description' => 'andresrangel.coorporation::lang.descriptions.orderBy',
                'type'        => 'dropdown',
                'default'     => 'id',
            ],
            'sort'     => [
                'title'       => 'andresrangel.coorporation::lang.labels.sort',
                'description' => 'andresrangel.coorporation::lang.descriptions.sort',
                'type'        => 'dropdown',
                'default'     => 'desc',
            ],
        ];
    }

    public function onRun()
    {
        $this->project = $this->page['project'] = $this->loadProject();
        $this->relatedProjects = $this->page['relatedProjects'] = $this->loadRelated();
    }

    protected function loadProject()
    {
        $slug = $this->property('slug');
        $project = ProjectModel::where('slug', $slug)->first();

        if ($project && $project->project_categories->count()) {
            $project->project_categories->each(function($category){
                $category->setUrl($this->categoryPage, $this->controller);
            });
        }

        return $project;
    }

    protected function loadRelated(){
        if($this->project && $this->project->project_categories->count()) {

            foreach($this->project->project_categories as $category){
                $cat_ids[] = $category->id;
            }

            $related = ProjectModel::with('picture')
                ->whereHas('categories',
                    function($query) use ($cat_ids){
                        $query->whereIn('id', $cat_ids);
                    })
                ->where('id', '<>', $this->project->id)
                ->take(3)
                ->get();
            return $related;
        }

    }

    public function getProjectCategoryPageOptions(){
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function getOrderByOptions()
    {
        $schema = Schema::getColumnListing('andresrangel_coorporation_projects');
        foreach ($schema as $column) {
            $options[$column] = ucwords(str_replace('_', ' ', $column));
        }
        return $options;
    }

    public function getSortOptions()
    {
        return [
            'desc' => Lang::get('andresrangel.coorporation::lang.labels.descending'),
            'asc'  => Lang::get('andresrangel.coorporation::lang.labels.ascending'),
        ];
    }

}