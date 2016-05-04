<?php namespace AndresRangel\Coorporation\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateEmployeesTable extends Migration
{

    public function up()
    {
        Schema::create('andresrangel_coorporation_employees', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('slug')->index()->unique();
            $table->text('description');
            $table->string('quote');
            $table->string('email');
            $table->string('phone');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('google');
            $table->date('born_at')->nullable();
            $table->date('published_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('andresrangel_coorporation_employees');
    }

}
