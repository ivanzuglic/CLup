<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreOccupancyDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_occupancy_data', function (Blueprint $table) {
            $table->increments('store_occupancy_data_id');
            $table->unsignedInteger('store_id');
            $table->time('interval_time_start');
            $table->time('interval_time_end');
            $table->float('number_of_customers');
            $table->timestamps();
        });

        Schema::table('store_occupancy_data', function (Blueprint $table) {
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
        Schema::table('store_occupancy_data', function (Blueprint $table) {
            $table->dropForeign('store_occupancy_data_store_id_foreign');
        });


        Schema::dropIfExists('store_occupancy_data');
    }
}
