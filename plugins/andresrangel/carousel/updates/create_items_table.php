<?php namespace AndresRangel\Carousel\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateItemsTable extends Migration
{

    public function up()
    {
        Schema::create('andresrangel_carousel_items', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('slide_id')->unsigned();
            $table->integer('item_type_id')->unsigned();
            $table->string('name');
            $table->string('xpos');
            $table->string('ypos');
            $table->string('hoffset');
            $table->string('voffset');
            $table->string('speed');
            $table->string('start');
            $table->string('easing');
            $table->string('elementdelay');
            $table->string('endelementdelay');
            $table->string('endspeed');
            $table->string('animation')->nullable();
            $table->string('text_format')->nullable();
            $table->text('content')->nullable();
            $table->string('endeasing')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->string('color')->nullable();
            $table->string('alpha')->nullable();
            $table->string('url')->nullable();
            $table->string('target')->nullable();
            $table->date('published_at');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('andresrangel_carousel_items');
    }

}
