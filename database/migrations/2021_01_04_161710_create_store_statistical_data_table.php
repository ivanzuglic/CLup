<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreStatisticalDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_statistical_data', function (Blueprint $table) {
            $table->increments('store_statistical_data_id');
            $table->unsignedInteger('store_id');
            $table->integer('avg_customers');
            $table->time('avg_time_spent');
            $table->date('date');
            $table->timestamps();
        });

        Schema::table('store_statistical_data', function (Blueprint $table) {
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
        Schema::table('store_statistical_data', function (Blueprint $table) {
            $table->dropForeign('store_statistical_data_store_id_foreign');
        });

        Schema::dropIfExists('store_statistical_data');
    }
}
