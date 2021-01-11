<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->bigIncrements('visit_id');
            $table->unsignedInteger('store_id');
            $table->time('enter_time');
            $table->time('exit_time');
            $table->date('date');
            $table->timestamps();
        });

        Schema::table('visits', function (Blueprint $table) {
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
        Schema::table('visits', function (Blueprint $table) {
            $table->dropForeign('visits_store_id_foreign');
        });

        Schema::dropIfExists('visits');
    }
}
