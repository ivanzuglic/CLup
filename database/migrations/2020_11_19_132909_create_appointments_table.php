<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('appointment_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('store_id');
            $table->unsignedInteger('appointment_type');
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('in_store');
            $table->boolean('done');
            $table->integer('lane');
            $table->timestamps();
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->foreign('store_id')->references('store_id')->on('stores');
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign('appointments_store_id_foreign');
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign('appointments_user_id_foreign');
        });

        Schema::dropIfExists('appointments');
    }
}
