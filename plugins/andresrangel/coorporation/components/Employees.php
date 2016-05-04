<?php namespace AndresRangel\Coorporation\Components;

use AndresRangel\Coorporation\Models\Employee;
use Cms\Classes\ComponentBase;

class Employees extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'andresrangel.coorporation::lang.components.employees.name',
            'description' => 'andresrangel.coorporation::lang.components.employees.description',
        ];
    }

    public function onRun()
    {
        if (is_numeric($id = $this->property('itemId'))) {
            $this->page['employee'] = Employee::whereId($id)->with('picture')->first();
        } else {
            $employees = Employee::published()
                ->with('picture')
                ->orderBy($this->property('orderBy', 'id'), $this->property('sort', 'desc'))
                ->take($this->property('maxItems'))
                ->get();
            $this->page['employees'] = $employees;
        }
    }

    public function getOrderByOptions()
    {
        $schema = Schema::getColumnListing('andresrangel_coorporation_employees');
        foreach ($schema as $column) {
            $options[$column] = ucwords(str_replace('_', ' ', $column));
        }
        return $options;
    }

}