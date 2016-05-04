<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 26/04/16
 * Time: 11:14
 */

namespace AndresRangel\Carousel\Updates;


use AndresRangel\Carousel\Models\ItemType;
use October\Rain\Database\Updates\Seeder;

class SeedItemTypesTable extends Seeder
{
    public function run()
    {
        $text = new ItemType();
        $text->name = "Text";
        $text->description = "Text type";

        $text->save();

        $background = new ItemType();
        $background->name = "Background";
        $background->description = "Background Type";

        $background->save();

        $button = new ItemType();
        $button->name = "Button";
        $button->description = "Button Type";

        $button->save();

        $image = new ItemType();
        $image->name = "Image";
        $image->description = "Image Type";

        $image->save();

    }

}