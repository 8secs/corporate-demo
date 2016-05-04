<?php namespace AndresRangel\Coorporation\Controllers;

use AndresRangel\Coorporation\Models\Technology;
use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use Lang;

/**
 * Technologies Back-end Controller
 */
class Technologies extends Controller
{
    public $requiredPermissions = ['andresrangel.coorporation.access_technologies'];

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

        BackendMenu::setContext('AndresRangel.Coorporation', 'coorporation', 'andresrangel.coorporation::lang.technologies.controller_label');
    }

    /**
     * Deleted checked services.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $serviceId) {
                if (!$service = Technology::find($serviceId)) {
                    continue;
                }

                $service->delete();
            }

            Flash::success(Lang::get('andresrangel.coorporation::lang.technologies.delete_selected_success'));
        } else {
            Flash::error(Lang::get('andresrangel.coorporation::lang.technologies.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}