<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersOnMonitoring extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_monitorings', function (Blueprint $table) {
            $table->integer('id_user')->unsigned();
            $table->integer('id_monitoring')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_monitoring')->references('id')->on('monitorings');
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
        Schema::dropIfExists('user_monitoring');
    }
}
