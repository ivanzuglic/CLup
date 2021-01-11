<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateStoreStatisticalDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('store_statistical_data', function (Blueprint $table) {
            $table->dropColumn('avg_time_spent');
            $table->dropColumn('date');
            $table->integer('avg_time_spent_min')->after('avg_customers');
            $table->integer('n_customers')->after('avg_time_spent_min');
            $table->integer('n_days')->after('n_customers');
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
            $table->dropColumn('avg_time_spent_min');
            $table->dropColumn('n_customers');
            $table->dropColumn('n_days');
            $table->time('avg_time_spent');
            $table->date('date');
        });
    }
}
