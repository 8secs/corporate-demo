<?php namespace AndresRangel\Carousel\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateItemTypesTable extends Migration
{

    public function up()
    {
        Schema::create('andresrangel_carousel_item_types', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('andresrangel_carousel_item_types');
    }

}
