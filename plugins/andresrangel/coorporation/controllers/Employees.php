<?php namespace AndresRangel\Coorporation\Controllers;

use AndresRangel\Coorporation\Models\Employee;
use Flash;
use Lang;
use BackendMenu;
use Backend\Classes\Controller;

/**
 * Employees Back-end Controller
 */
class Employees extends Controller
{
    public $requiredPermissions = ['andresrangel.coorporation.access_employees'];

    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController',
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $relationConfig = 'config_relation.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('AndresRangel.Coorporation', 'coorporation', 'andresrangel.coorporation::lang.employees.controller_label');
    }

    /**
     * Deleted checked employees.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $employeeId) {
                if (!$employee = Employee::find($employeeId)) {
                    continue;
                }

                $employee->delete();
            }

            Flash::success(Lang::get('andresrangel.coorporation::lang.employees.delete_selected_success'));
        } else {
            Flash::error(Lang::get('andresrangel.coorporation::lang.employees.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}