<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateStoreOccupancyDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('store_occupancy_data', function (Blueprint $table) {
            $table->dropColumn('interval_time_start');
            $table->dropColumn('interval_time_end');
            $table->dropColumn('number_of_customers');
            $table->json('array_customer_density')->after('store_id');
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
            $table->dropColumn('array_customer_density');
            $table->time('interval_time_start');
            $table->time('interval_time_end');
            $table->float('number_of_customers');
        });
    }
}
