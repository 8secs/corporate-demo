<?php namespace AndresRangel\Coorporation\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateProjectsTable extends Migration
{

    public function up()
    {
        Schema::create('andresrangel_coorporation_projects', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->index()->unique();
            $table->text('description');
            $table->string('customer');
            $table->string('url');
            $table->date('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('andresrangel_coorporation_projects');
    }

}
