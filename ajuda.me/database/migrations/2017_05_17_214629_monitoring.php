<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Monitoring extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitorings', function(Blueprint $table){
          $table->increments('id')->unique();
          $table->string('contentApproached');
          $table->string('type');
          $table->dateTime('startTime');
          $table->Time('duration');
          $table->integer('id_location')->unsigned();
          $table->integer('id_courses')->unsigned();
          $table->foreign('id_location')->references('id')->on('locations');
          $table->foreign('id_courses')->references('id')->on('courses');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monitorings');
    }
}
