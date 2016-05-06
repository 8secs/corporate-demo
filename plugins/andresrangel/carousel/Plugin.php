<?php namespace AndresRangel\Carousel;

use Backend;
use System\Classes\PluginBase;

/**
 * Carousel Plugin Information File
 * Integrate Video
 * Create and set css text formats
 *
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'andresrangel.carousel::lang.plugin.name',
            'description' => 'andresrangel.carousel::lang.plugin.description',
            'author'      => 'Andres Rangel',
            'icon'        => 'icon-caret-square-o-right',
        ];
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'AndresRangel\Carousel\Components\Carousel' => 'Slider',
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
            '\AndresRangel\Carousel\Components\Carousel' => 'Carousel'
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'andresrangel.carousel.access_carousel' => [
                'tab' => 'Carousel',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {

        return [
            'carousel' => [
                'label'       => 'Carousel',
                'url'         => Backend::url('andresrangel/carousel/carousel'),
                'icon'        => 'icon-caret-square-o-right',
                'permissions' => ['andresrangel.carousel.*'],
                'order'       => 500,

                'sideMenu'    => [
                    'carousel' => [
                        'label'       => 'andresrangel.carousel::lang.carousels.menu_label',
                        'icon'        => 'icon-caret-square-o-right',
                        'url'         => Backend::url('andresrangel/carousel/carousel'),
                        'permissions' => ['andresrangel.carousel.access_carousels'],
                        'description' => 'andresrangel.carousel::lang.carousel.description',
                    ],
                    'slides' => [
                        'label'       => 'andresrangel.carousel::lang.slides.menu_label',
                        'icon'        => 'icon-sliders',
                        'url'         => Backend::url('andresrangel/carousel/slides'),
                        'permissions' => ['andresrangel.carousel.access_carousels'],
                        'description' => 'andresrangel.carousel::lang.slides.description',
                    ],
                    'items' => [
                        'label'       => 'andresrangel.carousel::lang.items.menu_label',
                        'icon'        => 'icon-list',
                        'url'         => Backend::url('andresrangel/carousel/items'),
                        'permissions' => ['andresrangel.carousel.access_carousels'],
                        'description' => 'andresrangel.carousel::lang.items.description',
                    ],
                ],
            ],
        ];
    }

    public function registerMarkupTags()
    {
        return [
            'filters' => [
                'hex2rgb'  => [$this, 'hex2rgb']
            ]
        ];
    }

    public function register()
    {
        set_exception_handler([$this, 'handleException']);
    }

    /**
     * Workaround to resolve
     * TypeError: Argument 1 passed to October\Rain\Foundation\Exception\Handler::report() must be an instance of Exception
     * This error is fixed by octobercms/library@83888f4
     * witch Fixes seg fault (infinite loop) when using remember()
     * but while it's not in dev-master branch we use this workaround function
     * @param $e Exception
     */
    public function handleException($e)
    {
        if (! $e instanceof Exception) {
            $e = new \Symfony\Component\Debug\Exception\FatalThrowableError($e);
        }

        $handler = $this->app->make('Illuminate\Contracts\Debug\ExceptionHandler');
        $handler->report($e);

        if ($this->app->runningInConsole()) {
            $handler->renderForConsole(new ConsoleOutput, $e);
        } else {
            $handler->render($this->app['request'], $e)->send();
        }
    }

    public function hex2rgb($hex){
        $hex = str_replace("#", "", $hex);

        if(strlen($hex) == 3) {
            $r = hexdec(substr($hex,0,1).substr($hex,0,1));
            $g = hexdec(substr($hex,1,1).substr($hex,1,1));
            $b = hexdec(substr($hex,2,1).substr($hex,2,1));
        } else {
            $r = hexdec(substr($hex,0,2));
            $g = hexdec(substr($hex,2,2));
            $b = hexdec(substr($hex,4,2));
        }
        $rgb = array($r, $g, $b);
        return implode(",", $rgb); // returns the rgb values separated by commas
    }


    public function startPage($page = 'carouel')
    {
        $user = BackendAuth::getUser();
        $permissions = array_reverse(array_keys($this->registerPermissions()));

        if (!isset($user->permissions['superuser']) && $user->hasAccess('andresrangel.carousel.*')) {
            foreach ($permissions as $access) {
                if ($user->hasAccess($access)) {
                    $page = explode('_', $access)[1];
                }
            }
        }
        return $page;
    }

}
