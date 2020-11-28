<?php

use Illuminate\Database\Seeder;

class AppointmentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appointment_types')->insert([
            'appointment_type' => 'Reservation',
        ]);
        DB::table('appointment_types')->insert([
            'appointment_type' => 'Queue',
        ]);
        DB::table('appointment_types')->insert([
            'appointment_type' => 'Proxy',
        ]);
    }
}
