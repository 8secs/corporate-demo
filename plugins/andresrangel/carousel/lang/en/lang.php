<?php

return [
    'plugin'       => [
        'name'        => 'Momento Rev Slider',
        'description' => 'A Revolution Slider implementation plugin',
    ],
    'sidebar'      => [

    ],
    'components'   => [
        'carousel'      => [
            'name'        => 'Carousel Rev.',
            'description' => 'Implements a Carousel Slider Revolution',
        ]
    ],
    'descriptions' => [
        'maxItems' => 'Pick the maximum amout of results from your component',
        'itemId'   => 'Pick only one result from your component based on id number',
        'orderBy'  => 'Pick a column from which to order the results',
        'sort'     => 'Pick a direction to sort the results by',
    ],
    'labels'       => [
        'name'                      => 'Name',
        'published_at'              => 'Published',
        'picture'                   => 'Picture',
        'content'                   => 'Content',
        'background'                => 'Background',
        'description'               => 'Description',
        'updated_at'                => 'Updated',
        'transition'                => 'Transition',
        'effect'                    => 'Effect',
        'slotamount'                => 'Slot Amount',
        'slotamount-comment'        => 'The number of slots or boxes the slide is divided into. If you use boxfade, over 7 slots can be juggy',
        'masterspeed'               => 'Master Speed',
        'data'                      => 'Data',
        'x-position'                => 'X position',
        'x-comment'                 => 'Set item\'s horizontal position. Can use left, center and right or number',
        'y-position'                => 'Y position',
        'y-comment'                 => 'Set item\'s vertical position. Can use top, center, bottom or number',
        'h-offset'                  => 'Horizontal ofsset',
        'v-offset'                  => 'Vertial ofsset',
        'h-offset-comment'          => 'Set item\'s horizontal offset position',
        'v-offset-comment'          => 'Set item\'s vertical offset position',
        'speed'                     => 'Speed',
        'easing'                    => 'Easing',
        'start'                     => 'Start',
        'element-delay'             => 'Element Delay',
        'end-element-delay'         => 'End element delay',
        'end-speed'                 => 'End Speed',
        'end-easing'                => 'End Easing',
        'animation'                 => 'Animation',
        'format'                    => 'Format',
        'width'                     => 'Width',
        'height'                    => 'Height',
        'color'                     => 'Color',
        'alpha'                     => 'Alpha',
        'alpha-comment'             => 'Must be between 0 and 1',
        'url'                       => 'Url',
        'target'                    => 'Target',
        'descending'                => 'Descending',
        'ascending'                 => 'Ascending',
        'maxItems'                  => 'Max items',
        'itemId'                    => 'Id',
        'orderBy'                   => 'Order by',
        'sort'                      => 'Direction',

    ],
    'carousel'      => [
        'new'           => 'New Carousel',
        'label'         => 'Carousel',
        'create_title'  => 'Create Carousel',
        'update_title'  => 'Edit Carousel',
        'preview_title' => 'Preview Carousel',
        'list_title'    => 'Manage Carousel',
        'description'   => 'Carousel Item',
    ],
    'carousels'     =>[
        'delete_selected_confirm' => 'Delete the selected carousels?',
        'controller_label'        => 'Carousel',
        'menu_label'              => 'Carousel',
        'return_to_list'          => 'Return to Carousels',
        'delete_confirm'          => 'Do you really want to delete this carousel?',
        'delete_selected_success' => 'Successfully deleted the selected carousels.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
    ],
    'slide'     => [
        'new'           => 'New Slide',
        'label'         => 'Slide',
        'create_title'  => 'Create Slide',
        'update_title'  => 'Edit Slide',
        'preview_title' => 'Preview Slide',
        'list_title'    => 'Manage Slides',
        'description'   => 'Slide Item'
    ],
    'slides'    => [
        'delete_selected_confirm' => 'Delete the selected slides?',
        'controller_label'        => 'slides',
        'menu_label'              => 'Slides',
        'return_to_list'          => 'Return to Slides',
        'delete_confirm'          => 'Do you really want to delete this slide?',
        'delete_selected_success' => 'Successfully deleted the selected slides.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
    ],
    'item'     => [
        'new'           => 'New Item',
        'label'         => 'Item',
        'create_title'  => 'Create Item',
        'update_title'  => 'Edit Item',
        'preview_title' => 'Preview Item',
        'list_title'    => 'Manage Items',
        'description'   => 'Item Item'
    ],
    'items'    => [
        'delete_selected_confirm' => 'Delete the selected Items?',
        'controller_label'        => 'Items',
        'menu_label'              => 'Items',
        'return_to_list'          => 'Return to Items',
        'delete_confirm'          => 'Do you really want to delete this item?',
        'delete_selected_success' => 'Successfully deleted the selected Items.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
    ],
    'itemtype'     => [
        'new'           => 'New Type',
        'label'         => 'Type',
        'create_title'  => 'Create Type',
        'update_title'  => 'Edit Type',
        'preview_title' => 'Preview Type',
        'list_title'    => 'Manage Types',
        'description'   => 'Type Item'
    ],
    'itemtypes'    => [
        'delete_selected_confirm' => 'Delete the selected Item-types?',
        'controller_label'        => 'types',
        'menu_label'              => 'Types',
        'return_to_list'          => 'Return to Types',
        'delete_confirm'          => 'Do you really want to delete this types?',
        'delete_selected_success' => 'Successfully deleted the selected types.',
        'delete_selected_empty'   => 'There are no selected :name to delete.',
    ],
    
];