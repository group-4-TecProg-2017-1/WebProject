<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersOnStudyGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_study_group', function (Blueprint $table) {
            $table->integer('id_user')->unsigned();
            $table->integer('id_study_group')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_study_group')->references('id')->on('study_groups');
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
        Schema::dropIfExists('user_study_group');
    }
}
