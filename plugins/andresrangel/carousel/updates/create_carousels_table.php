<?php namespace AndresRangel\Carousel\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateCarouselsTable extends Migration
{

    public function up()
    {
        Schema::create('andresrangel_carousel_carousels', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->date('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('andresrangel_carousel_carousels');
    }

}
