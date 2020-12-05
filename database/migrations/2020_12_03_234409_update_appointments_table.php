<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->time('store_entered_at')->nullable()->after('end_time');
            $table->time('store_exited_at')->nullable()->after('store_entered_at');
            $table->dropColumn('in_store');
            $table->dropColumn('done');
            $table->dropForeign('appointments_user_id_foreign');
            $table->dropColumn('user_id');
            $table->enum('status', ['waiting', 'in store', 'done'])->after('lane');
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable()->after('store_id');
            $table->foreign('user_id')->references('id')->on('users');
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
            $table->dropColumn('store_entered_at');
            $table->dropColumn('store_exited_at');
            $table->boolean('in_store');
            $table->boolean('done');
            $table->dropColumn('status');
        });
    }
}
