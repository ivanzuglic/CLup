<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkingHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_hours', function (Blueprint $table) {
            $table->increments('working_hours_id');
            $table->unsignedInteger('store_id');
            $table->integer('day');
            $table->time('opening_hours');
            $table->time('closing_hours');
            $table->timestamps();
        });

        Schema::table('working_hours', function (Blueprint $table) {
            $table->foreign('store_id')->references('store_id')->on('stores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('working_hours', function (Blueprint $table) {
            $table->dropForeign('working_hours_store_id_foreign');
        });

        Schema::dropIfExists('working_hours');
    }
}
