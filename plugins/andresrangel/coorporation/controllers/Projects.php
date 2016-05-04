<?php namespace AndresRangel\Coorporation\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use Lang;
use AndresRangel\Coorporation\Models\Project;

/**
 * Projects Back-end Controller
 */
class Projects extends Controller
{
    public $requiredPermissions = ['andresrangel.coorporation.access_projects'];

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

        BackendMenu::setContext('AndresRangel.Coorporation', 'coorporation', 'andresrangel.coorporation::lang.projects.controller_label');
    }

    /**
     * Deleted checked projects.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $projectId) {
                if (!$project = Project::find($projectId)) {
                    continue;
                }

                $project->delete();
            }

            Flash::success(Lang::get('andresrangel.coorporation::lang.projects.delete_selected_success'));
        } else {
            Flash::error(Lang::get('andresrangel.coorporation::lang.projects.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}