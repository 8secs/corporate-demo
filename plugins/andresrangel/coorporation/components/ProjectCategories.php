<?php namespace AndresRangel\Coorporation\Components;

use Db;
use App;
use Request;
use Flash;
use AndresRangel\Coorporation\Models\ProjectCategory;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;

class ProjectCategories extends ComponentBase
{

    /**
     * @var Collection A collection of categories to display
     */
    public $projectCategories;

    /**
     * @var string Reference to the page name for linking to categories.
     */
    public $projectCategoryPage;

    /**
     * @var string Reference to the current category slug.
     */
    public $currentCategorySlug;

    public function componentDetails()
    {
        return [
            'name'        => 'andresrangel.coorporation::lang.components.project_categories.name',
            'description' => 'andresrangel.coorporation::lang.components.project_categories.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'slug' => [
                'title'       => 'andresrangel.coorporation::lang.labels.slug',
                'description' => 'andresrangel.coorporation::lang.labels.slug_description',
                'default'     => '{{ :slug }}',
                'type'        => 'string'
            ],
            'displayEmpty' => [
                'title'       => 'andresrangel.coorporation::lang.labels.display_empty',
                'description' => 'andresrangel.coorporation::lang.labels.display_empty_description',
                'type'        => 'checkbox',
                'default'     => 0
            ],
            'projectCategoryPage' => [
                'title'       => 'andresrangel.coorporation::lang.project_category.label',
                'description' => 'andresrangel.coorporation::lang.lang.project_category.description',
                'type'        => 'dropdown',
                'default'     => 'portfolio/category',
                'group'       => 'Links',
            ],
        ];
    }

    public function getProjectCategoryPageOptions(){
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function onRun()
    {
        $this->currentCategorySlug = $this->page['currentCategorySlug'] = $this->property('slug');
        $this->projectCategoryPage = $this->page['projectCategoryPage'] = $this->property('projectCategoryPage');
        $this->projectCategories = $this->page['projectCategories'] = $this->loadCategories();
    }

    protected function loadCategories()
    {
        $projectCategories = ProjectCategory::orderBy('name');
        if (!$this->property('displayEmpty')) {
            $projectCategories->whereExists(function($query) {
                $query->select(Db::raw(1))
                    ->from('andresrangel_coorporation_project_categories');
            });
        }

        $projectCategories = $projectCategories->getNested();
        return $this->linkCategories($projectCategories);
    }

    protected function linkCategories($projectCategories)
    {
        return $projectCategories->each(function($projectCategory) {
            $projectCategory->setUrl($this->projectCategoryPage, $this->controller);

            if ($projectCategory->children) {
                $this->linkCategories($projectCategory->children);
            }
        });
    }

}