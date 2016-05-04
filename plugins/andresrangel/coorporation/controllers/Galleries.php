<?php namespace AndresRangel\Coorporation\Controllers;

use AndresRangel\Coorporation\Models\Gallery;
use Flash;
use Lang;
use BackendMenu;
use Backend\Classes\Controller;

/**
 * Galleries Back-end Controller
 */
class Galleries extends Controller
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

        BackendMenu::setContext('AndresRangel.Coorporation', 'coorporation', 'andresrangel.coorporation::lang.galleries.controller_label');
    }

    /**
     * Deleted checked galleries.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $galleryId) {
                if (!$gallery = Gallery::find($galleryId)) {
                    continue;
                }

                $gallery->delete();
            }

            Flash::success(Lang::get('andresrangel.coorporation::lang.galleries.delete_selected_success'));
        } else {
            Flash::error(Lang::get('andresrangel.coorporation::lang.galleries.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}