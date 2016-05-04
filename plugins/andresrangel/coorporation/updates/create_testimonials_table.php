<?php namespace AndresRangel\Coorporation\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateTestimonialsTable extends Migration
{

    public function up()
    {
        Schema::create('andresrangel_coorporation_testimonials', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('content');
            $table->string('source');
            $table->string('url');
            $table->date('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('andresrangel_coorporation_testimonials');
    }

}
