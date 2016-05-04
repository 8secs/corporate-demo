<?php namespace AndresRangel\Coorporation\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateServicesTable extends Migration
{

    public function up()
    {
        Schema::create('andresrangel_coorporation_services', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('icon');
            $table->text('description');
            $table->date('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('andresrangel_coorporation_services');
    }

}
