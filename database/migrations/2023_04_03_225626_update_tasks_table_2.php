<?php

use Faker\Core\Blood;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTasksTable_2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("tasks", function(Blueprint $table){
            $table->date('prev_start');
            $table->date('prev_end');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("tasks", function(Blueprint $table){
            $table->dropColumn(['prev_start', 'prev_end']);
        });
    }
}
