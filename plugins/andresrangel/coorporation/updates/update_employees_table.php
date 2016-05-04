<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 2/05/16
 * Time: 11:17
 */

namespace AndresRangel\Coorporation\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class UpdateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::table('andresrangel_coorporation_employees', function($table)
        {
            $table->timestamps();
        });
    }
}