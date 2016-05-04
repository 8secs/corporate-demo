<?php namespace AndresRangel\Coorporation\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateProjectCategoriesTable extends Migration
{

    public function up()
    {
        Schema::create('andresrangel_coorporation_project_categories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->index();
            $table->string('slug')->index()->unique();
            $table->text('description')->nullable();
            $table->integer('parent_id')->unsigned()->index()->nullable();
            $table->integer('nest_left')->default(0);
            $table->integer('nest_right')->default(0);
            $table->integer('nest_depth')->default(0);
            $table->date('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('andresrangel_coorporation_project_categories');
    }

}
