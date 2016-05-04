<?php namespace AndresRangel\Coorporation\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Schema;
use Redirect;
use Cms\Classes\Page;
use AndresRangel\Coorporation\Models\Project;
use AndresRangel\Coorporation\Models\ProjectCategory;

class Projects extends Component
{

    /**
     * A collection of projects to display
     * @var Collection
     */
    public $projects;

    /**
     * Parameter to use for the page number
     * @var string
     */
    public $pageParam;

    /**
     * If the post list should be filtered by a category, the model to use.
     * @var Model
     */
    public $project_category;

    /**
     * Message to display when there are no messages.
     * @var string
     */
    public $noProjectMessage;

    /**
     * Reference to the page name for linking to projects.
     * @var string
     */
    public $projectPage;

    /**
     * Reference to the page name for linking to categories.
     * @var string
     */
    public $projectCategoryPage;

    /**
     * If the post list should be ordered by another attribute.
     * @var string
     */
    public $sortOrder;

    public function componentDetails()
    {
        return [
            'name'        => 'andresrangel.coorporation::lang.components.projects.name',
            'description' => 'andresrangel.coorporation::lang.components.projects.description',
        ];
    }

    public function defineProperties()
    {
        return [
            'pageNumber' => [
                'title'       => 'andresrangel.coorporation::lang.projects.project_pagination',
                'description' => 'andresrangel.coorporation::lang.projects.project_pagination_description',
                'type'        => 'string',
                'default'     => '{{ :page }}',
            ],
            'projectCategoryFilter' => [
                'title'       => 'andresrangel.coorporation::lang.projects.projects_filter',
                'description' => 'andresrangel.coorporation::lang.projects.projects_filter_description',
                'type'        => 'string',
                'default'     => ''
            ],
            'projectsPerPage' => [
                'title'             => 'andresrangel.coorporation::lang.projects.projects_per_page',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'andresrangel.coorporation::lang.projects.projects_per_page_validation',
                'default'           => '10',
            ],
            'noProjectsMessage' => [
                'title'        => 'andresrangel.coorporation::lang.projects.projects_no_projects',
                'description'  => 'andresrangel.coorporation::lang.projects.projects_no_projects_description',
                'type'         => 'string',
                'default'      => 'No projects found',
                'showExternalParam' => false
            ],
            'sortOrder' => [
                'title'       => 'andresrangel.coorporation::lang.projects.projects_order',
                'description' => 'andresrangel.coorporation::lang.projects.projects_order_description',
                'type'        => 'dropdown',
                'default'     => 'published_at desc'
            ],
            'projectCategoryPage' => [
                'title'       => 'andresrangel.coorporation::lang.project_category.label',
                'description' => 'andresrangel.coorporation::lang.project_category.description',
                'type'        => 'dropdown',
                'default'     => 'portfolio/category',
                'group'       => 'Links',
            ],
            'projectPage' => [
                'title'       => 'andresrangel.coorporation::lang.projects.projects_post',
                'description' => 'andresrangel.coorporation::lang.projects.projects_post_description',
                'type'        => 'dropdown',
                'default'     => 'portfolio/project',
                'group'       => 'Links',
            ],
        ];
    }

    public function getProjectCategoryPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function getProjectPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function getSortOrderOptions()
    {
        return Project::$allowedSortingOptions;
    }

    public function onRun()
    {
        $this->prepareVars();

        $this->project_category = $this->page['project_category'] = $this->loadCategory();
        $this->projects = $this->page['projects'] = $this->listProjects();

        /*
         * If the page number is not valid, redirect
         */
        if ($pageNumberParam = $this->paramName('pageNumber')) {
            $currentPage = $this->property('pageNumber');

            if ($currentPage > ($lastPage = $this->projects->lastPage()) && $currentPage > 1)
                return Redirect::to($this->currentPageUrl([$pageNumberParam => $lastPage]));
        }
    }

    protected function prepareVars()
    {
        $this->pageParam = $this->page['pageParam'] = $this->paramName('pageNumber');
        $this->noProjectsMessage = $this->page['noProjectsMessage'] = $this->property('noProjectsMessage');

        /*
         * Page links
         */
        $this->projectPage = $this->page['projectPage'] = $this->property('projectPage');
        $this->projectCategoryPage = $this->page['projectCategoryPage'] = $this->property('projectCategoryPage');
    }

    protected function listProjects()
    {
        $project_category = $this->project_category ? $this->project_category->id : null;

        /*
         * List all the projects, eager load their categories
         */
        $projects = Project::with('project_categories')->listFrontEnd([
            'page'       => $this->property('pageNumber'),
            'sort'       => $this->property('sortOrder'),
            'perPage'    => $this->property('projectsPerPage'),
            'project_category'   => $project_category
        ]);
        //print_r($projects);
        //return $projects;

        /*
         * Add a "url" helper attribute for linking to each post and project_category
         */
        $projects->each(function($project) {
            $project->setUrl($this->projectPage, $this->controller);

            $project->project_categories->each(function($project_category) {
                $project_category->setUrl($this->projectCategoryPage, $this->controller);
            });
        });

        return $projects;
    }

    protected function loadCategory()
    {
        if (!$project_categoryId = $this->property('projectCategoryFilter'))
            return null;

        if (!$project_category = ProjectCategory::whereSlug($project_categoryId)->first())
            return null;

        return $project_category;
    }

}