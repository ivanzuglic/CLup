<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_types', function (Blueprint $table) {
            $table->increments('type_id');
            $table->string('appointment_type');
            $table->timestamps();
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->foreign('appointment_type')->references('type_id')->on('appointment_types');
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
            $table->dropForeign('appointments_appointment_type_foreign');
        });

        Schema::dropIfExists('appointment_types');
    }
}
