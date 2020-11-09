<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('store_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedInteger('store_type');
            $table->text('address');
            $table->string('image_reference')->nullable();
            $table->integer('max_occupancy');
            $table->integer('current_occupancy');
            $table->float('max_reservation_ratio')->default('1.0');
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
        Schema::dropIfExists('stores');
    }
}
