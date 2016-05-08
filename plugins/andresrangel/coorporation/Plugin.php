<?php namespace AndresRangel\Coorporation;

use Backend;
use BackendMenu;
use Backend\Facades\BackendAuth;
use System\Classes\PluginBase;

/**
 * coorporation Plugin Information File
 */
class Plugin extends PluginBase
{

    public $require = ['RainLab.Location'];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'andresrangel.coorporation::lang.plugin.name',
            'description' => 'andresrangel.coorporation::lang.plugin.description',
            'author'      => 'Andres Rangel',
            'icon'        => 'icon-building',
        ];
    }

    public function registerNavigation()
    {
        return [
            'coorporation' => [
                'label'       => 'andresrangel.coorporation::lang.plugin.name',
                'url'         => Backend::url('andresrangel/coorporation/'. $this->startPage()),
                'icon'        => 'icon-building',
                'permissions' => ['andresrangel.coorporation.*'],
                'order'       => 500,

                'sideMenu'    => [
                    'employees'    => [
                        'label'       => 'andresrangel.coorporation::lang.employees.menu_label',
                        'icon'        => 'icon-user',
                        'url'         => Backend::url('andresrangel/coorporation/employees'),
                        'permissions' => ['andresrangel.coorporation.access_employees'],
                        'group'       => 'andresrangel.coorporation::lang.sidebar.team',
                        'description' => 'andresrangel.coorporation::lang.employee.description',

                    ],
                    'roles'        => [
                        'label'       => 'andresrangel.coorporation::lang.roles.menu_label',
                        'icon'        => 'icon-briefcase',
                        'url'         => Backend::url('andresrangel/coorporation/roles'),
                        'permissions' => ['andresrangel.coorporation.access_employees'],
                        'group'       => 'andresrangel.coorporation::lang.sidebar.team',
                        'description' => 'andresrangel.coorporation::lang.role.description',
                    ],
                    'projects'     => [
                        'label'       => 'andresrangel.coorporation::lang.projects.menu_label',
                        'icon'        => 'icon-wrench',
                        'url'         => Backend::url('andresrangel/coorporation/projects'),
                        'permissions' => ['andresrangel.coorporation.access_projects'],
                        'group'       => 'andresrangel.coorporation::lang.sidebar.projects',
                        'description' => 'andresrangel.coorporation::lang.project.description',
                    ],
                    'project_categories'     => [
                        'label'       => 'andresrangel.coorporation::lang.project_categories.menu_label',
                        'icon'        => 'icon-server',
                        'url'         => Backend::url('andresrangel/coorporation/projectcategories'),
                        'permissions' => ['andresrangel.coorporation.access_project_categories'],
                        'group'       => 'andresrangel.coorporation::lang.sidebar.projects',
                        'description' => 'andresrangel.coorporation::lang.project_category.description',
                    ],
                    'services'     => [
                        'label'       => 'andresrangel.coorporation::lang.services.menu_label',
                        'icon'        => 'icon-cogs',
                        'url'         => Backend::url('andresrangel/coorporation/services'),
                        'permissions' => ['andresrangel.coorporation.access_services'],
                        'group'       => 'andresrangel.coorporation::lang.sidebar.projects',
                        'description' => 'andresrangel.coorporation::lang.service.description',
                    ],
                    'technologies'     => [
                        'label'       => 'andresrangel.coorporation::lang.technologies.menu_label',
                        'icon'        => 'icon-empire',
                        'url'         => Backend::url('andresrangel/coorporation/technologies'),
                        'permissions' => ['andresrangel.coorporation.access_technologies'],
                        'group'       => 'andresrangel.coorporation::lang.sidebar.projects',
                        'description' => 'andresrangel.coorporation::lang.technology.description',
                    ],
                    'galleries'    => [
                        'label'       => 'andresrangel.coorporation::lang.galleries.menu_label',
                        'icon'        => 'icon-photo',
                        'url'         => Backend::url('andresrangel/coorporation/galleries'),
                        'permissions' => ['andresrangel.coorporation.access_galleries'],
                        'group'       => 'andresrangel.coorporation::lang.sidebar.media',
                        'description' => 'andresrangel.coorporation::lang.gallery.description',
                    ],
                    'testimonials' => [
                        'label'       => 'andresrangel.coorporation::lang.testimonials.menu_label',
                        'icon'        => 'icon-comment',
                        'url'         => Backend::url('andresrangel/coorporation/testimonials'),
                        'permissions' => ['andresrangel.coorporation.access_testimonials'],
                        'group'       => 'andresrangel.coorporation::lang.sidebar.clients',
                        'description' => 'andresrangel.coorporation::lang.testimonial.description',
                    ],
                ],
            ],
        ];
    }

    public function startPage($page = 'projects')
    {
        $user = BackendAuth::getUser();
        $permissions = array_reverse(array_keys($this->registerPermissions()));

        if (!isset($user->permissions['superuser']) && $user->hasAccess('andresrangel.coorporation.*')) {
            foreach ($permissions as $access) {
                if ($user->hasAccess($access)) {
                    $page = explode('_', $access)[1];
                }
            }
        }
        //print_r($page);
        return $page;
    }

    public function registerPermissions()
    {
        return [
            'andresrangel.coorporation.access_employees'    => [
                'label' => 'andresrangel.coorporation::lang.employee.list_title',
                'tab'   => 'andresrangel.coorporation::lang.plugin.name',
            ],
            'andresrangel.coorporation.access_projects'     => [
                'label' => 'andresrangel.coorporation::lang.project.list_title',
                'tab'   => 'andresrangel.coorporation::lang.plugin.name',
            ],
            'andresrangel.coorporation.access_services'     => [
                'label' => 'andresrangel.coorporation::lang.service.list_title',
                'tab'   => 'andresrangel.coorporation::lang.plugin.name',
            ],
            'andresrangel.coorporation.access_technologies'     => [
                'label' => 'andresrangel.coorporation::lang.technologies.list_title',
                'tab'   => 'andresrangel.coorporation::lang.plugin.name',
            ],
            'andresrangel.coorporation.access_project_categories'      => [
                'label' => 'andresrangel.coorporation::lang.project_categories.list_title',
                'tab'   => 'andresrangel.coorporation::lang.plugin.name',
            ],
            'andresrangel.coorporation.access_galleries'    => [
                'label' => 'andresrangel.coorporation::lang.gallery.list_title',
                'tab'   => 'andresrangel.coorporation::lang.plugin.name',
            ],
            'andresrangel.coorporation.access_testimonials' => [
                'label' => 'andresrangel.coorporation::lang.testimonial.list_title',
                'tab'   => 'andresrangel.coorporation::lang.plugin.name',
            ],
            'andresrangel.coorporation.access_company'      => [
                'label' => 'andresrangel.coorporation::lang.company.list_title',
                'tab'   => 'andresrangel.coorporation::lang.plugin.name',
            ],
        ];
    }

    public function registerComponents()
    {
        return [
            'AndresRangel\Coorporation\Components\Employees'               => 'Employees',
            'AndresRangel\Coorporation\Components\Projects'                => 'Projects',
            'AndresRangel\Coorporation\Components\Project'                 => 'Project',
            'AndresRangel\Coorporation\Components\ProjectCategories'       => 'ProjectCategories',
            'AndresRangel\Coorporation\Components\Services'                => 'Services',
            'AndresRangel\Coorporation\Components\Galleries'               => 'Galleries',
            'AndresRangel\Coorporation\Components\Company'                 => 'Company',
            'AndresRangel\Coorporation\Components\Testimonials'            => 'Testimonials',
        ];
    }

    /**
     * Register snippets with the RainLab.Pages plugin.
     *
     * @return array
     * @see https://octobercms.com/plugin/rainlab-pages
     */
    public function registerPageSnippets()
    {
        return [
            //'AndresRangel\Coorporation\Components\Projects'                => 'Projects',
        ];
    }

    public function registerSettings()
    {
        return [
            'company' => [
                'label'       => 'andresrangel.coorporation::lang.plugin.name',
                'description' => 'andresrangel.coorporation::lang.settings.description',
                'category'    => 'system::lang.system.categories.system',
                'icon'        => 'icon-building-o',
                'class'       => 'AndresRangel\coorporation\Models\Company',
                'order'       => 500,
                'keywords'    => 'andresrangel.coorporation::lang.settings.label',
                'permissions' => ['andresrangel.coorporation.access_company'],
            ],
        ];
    }

    public function register()
    {
        BackendMenu::registerContextSidenavPartial('AndresRangel.Coorporation', 'coorporation', '@/plugins/andresrangel/coorporation/partials/_sidebar.htm');
    }

}
