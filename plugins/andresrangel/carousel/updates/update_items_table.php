<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 25/04/16
 * Time: 14:16
 */

namespace AndresRangel\Carousel\Updates;


use Schema;
use October\Rain\Database\Updates\Migration;

class UpdateItemsTable extends Migration
{
    public function up()
    {
        Schema::table('andresrangel_carousel_items', function($table){
            /*$table->string('animation')->nullable();
            $table->string('color')->nullable();
            $table->text('content')->nullable();
            $table->string('endeasing')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();*/
        });
    }

}