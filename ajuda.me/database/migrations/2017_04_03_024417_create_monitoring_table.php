<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonitoringTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitoring', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('place');
            $table->string('content');
            $table->time('starting_time');
            $table->time('duration');
            $table->integer('course_id')->unsigned();
            $table->integer('monitor_id')->unsigned();
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('monitor_id')->references('id')->on('monitors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monitoring');
    }
}
