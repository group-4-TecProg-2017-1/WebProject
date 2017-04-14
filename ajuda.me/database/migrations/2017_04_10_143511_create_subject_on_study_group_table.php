<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectOnStudyGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_study_group', function (Blueprint $table) {
            $table->integer('id_subject')->unsigned();
            $table->integer('id_study_group')->unsigned();
            $table->foreign('id_subject')->references('id')->on('subject');
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
        Schema::dropIfExists('subject_study_group');
    }
}
