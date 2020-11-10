<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_types', function (Blueprint $table) {
            $table->increments('type_id');
            $table->string('store_type');
            $table->timestamps();
        });

        Schema::table('stores', function (Blueprint $table) {
            $table->foreign('store_type')->references('type_id')->on('store_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropForeign('stores_store_type_foreign');
        });

        Schema::dropIfExists('store_types');
    }
}
