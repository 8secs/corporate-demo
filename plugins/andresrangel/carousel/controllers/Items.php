<?php namespace AndresRangel\Carousel\Controllers;

use AndresRangel\Carousel\Models\Item;
use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use Lang;

/**
 * Items Back-end Controller
 */
class Items extends Controller
{
    public $requiredPermissions = ['andresrangel.carousel.access_items'];

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

        BackendMenu::setContext('AndresRangel.Carousel', 'carousel', 'andresrangel.carousel::lang.items.controller_label');
    }

    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $itemId) {
                if (!$item = Item::find($itemId)) {
                    continue;
                }

                $item->delete();
            }

            Flash::success(Lang::get('andresrangel.carousel::lang.items.delete_selected_success'));
        } else {
            Flash::error(Lang::get('andresrangel.carousel::lang.items.delete_selected_empty'));
        }

        return $this->listRefresh();
    }


}