<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stores', function (Blueprint $table) {
            // Dropping the simple address column
            $table->dropColumn('address');
            // Adding more complex address columns
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('zip_code');
            $table->string('town');
            $table->string('country');
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
            // Dropping more complex address columns
            $table->dropColumn('address_line_1');
            $table->dropColumn('address_line_2')->nullable();
            $table->dropColumn('zip_code');
            $table->dropColumn('town');
            $table->dropColumn('country');
            // Adding the simple address column back
            $table->text('address');
        });
    }
}
