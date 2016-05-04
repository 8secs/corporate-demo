<?php namespace AndresRangel\Coorporation\Components;

use AndresRangel\Coorporation\Models\Service;
use Cms\Classes\ComponentBase;

class Services extends ComponentBase
{

    public $services;

    public function componentDetails()
    {
        return [
            'name'        => 'andresrangel.coorporation::lang.components.services.name',
            'description' => 'andresrangel.coorporation::lang.components.services.description'
        ];
    }

    public function onRun()
    {
        if (is_numeric($id = $this->property('itemId'))) {
            $this->page['service'] = Service::find($id);
        } else {
            $services = Service::published()
                ->orderBy($this->property('orderBy', 'id'), $this->property('sort', 'desc'))
                ->take($this->property('maxItems'))
                ->get();
            $this->page['services'] = $services;

        }
    }

    public function getOrderByOptions()
    {
        $schema = Schema::getColumnListing('andresrangel_coorporation_services');
        foreach ($schema as $column) {
            $options[$column] = ucwords(str_replace('_', ' ', $column));
        }
        return $options;
    }

}