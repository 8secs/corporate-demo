<?php namespace AndresRangel\Carousel\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Lang;
use Schema;
use AndresRangel\Carousel\Models\Carousel as CarouselModel;

class Carousel extends ComponentBase
{
    public $carousel;

    public $carousels;

    public function componentDetails()
    {
        return [
            'name'        => 'andresrangel.carousel::lang.components.carousel.name',
            'description' => 'andresrangel.carousel::lang.components.carousel.description',
        ];
    }

    public function defineProperties()
    {
        return [
            'maxItems' => [
                'title'             => 'andresrangel.carousel::lang.labels.maxItems',
                'description'       => 'andresrangel.carousel::lang.descriptions.maxItems',
                'default'           => 20,
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
            ],
            'itemId'   => [
                'title'             => 'andresrangel.carousel::lang.labels.itemId',
                'description'       => 'andresrangel.carousel::lang.descriptions.itemId',
                'default'           => '',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
            ],
            'orderBy'  => [
                'title'       => 'andresrangel.carousel::lang.labels.orderBy',
                'description' => 'andresrangel.carousel::lang.descriptions.orderBy',
                'type'        => 'dropdown',
                'default'     => 'id',
            ],
            'sort'     => [
                'title'       => 'andresrangel.carousel::lang.labels.sort',
                'description' => 'andresrangel.carousel::lang.descriptions.sort',
                'type'        => 'dropdown',
                'default'     => 'desc',
            ],
        ];
    }

    public function getSortOptions()
    {
        return [
            'desc' => Lang::get('andresrangel.carousel::lang.labels.descending'),
            'asc'  => Lang::get('andresrangel.carousel::lang.labels.ascending'),
        ];
    }

    public function onRun()
    {
        if (is_numeric($id = $this->property('itemId'))) {
            $this->carousel = $this->page['carousel'] = CarouselModel::whereId($id)
                                                                        ->with('slides')
                                                                        ->with('slides.image')
                                                                        ->with('slides.items')
                                                                        ->first();
        } else {
            $carousels = CarouselModel::published()
                ->orderBy($this->property('orderBy', 'id'), $this->property('sort', 'desc'))
                ->take($this->property('maxItems'))
                ->get();
            $this->carousels = $this->page['carousels'] = $carousels;
        }

    }

    public function getOrderByOptions()
    {
        $schema = Schema::getColumnListing('andresrangel_carousel_carousels');
        foreach ($schema as $column) {
            $options[$column] = ucwords(str_replace('_', ' ', $column));
        }
        return $options;
    }

}