<?php namespace AndresRangel\Coorporation\Components;

use AndresRangel\Coorporation\Models\Testimonial;
use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Schema;

class Testimonials extends ComponentBase
{

    public $testimonials;

    public function componentDetails()
    {
        return [
            'name'        => 'andresrangel.coorporation::lang.components.testimonials.name',
            'description' => 'andresrangel.coorporation::lang.components.testimonials.description',
        ];
    }

    public function onRun()
    {
        if (is_numeric($id = $this->property('itemId'))) {
            $this->page['testimonial'] = Testimonial::whereId($id)->with('picture')->first();
        } else {
            $testimonials = Testimonial::published()
                ->with('picture')
                ->orderBy($this->property('orderBy', 'id'), $this->property('sort', 'desc'))
                ->take($this->property('maxItems'))
                ->get();
            $this->testimonials = $this->page['testimonials'] = $testimonials;
        }
    }

    public function getOrderByOptions()
    {
        $schema = Schema::getColumnListing('andresrangel_coorporation_testimonials');
        foreach ($schema as $column) {
            $options[$column] = ucwords(str_replace('_', ' ', $column));
        }
        return $options;
    }

}