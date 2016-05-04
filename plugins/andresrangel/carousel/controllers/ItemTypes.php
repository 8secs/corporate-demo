<?php namespace AndresRangel\Carousel\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use Lang;

/**
 * Item Types Back-end Controller
 */
class ItemTypes extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('AndresRangel.Carousel', 'carousel', 'andresrangel.carousel::lang.itemtypes.controller_label');
    }

    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $employeeId) {
                if (!$employee = Employee::find($employeeId)) {
                    continue;
                }

                $employee->delete();
            }

            Flash::success(Lang::get('andresrangel.carousel::lang.itemtypes.delete_selected_success'));
        } else {
            Flash::error(Lang::get('andresrangel.carousel::lang.itemtypes.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}