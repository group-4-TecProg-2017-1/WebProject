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


        /**
        * Create table of study group 
        *
        * @return void
        */
        Schema::create('study_groups' , function (Blueprint $table){
            $table->increments('id')->unique();
            $table->string('email_user_creator');
            $table->string('contentApproached');
            $table->dateTime('startTime');
            $table->Time('duration');
            $table->integer('id_location')->unsigned();
            $table->foreign('id_location')->references('id')->on('locations');
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
