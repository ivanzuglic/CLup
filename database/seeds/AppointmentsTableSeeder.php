<?php

use Illuminate\Database\Seeder;

class AppointmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appointments')->insert([
            'user_id' => '2',
            'store_id' => '1',
            'appointment_type' => '1',
            'start_time' => '08:00',
            'end_time' => '09:00',
            'in_store' => '0',
            'done' => '0',
            'lane' => '1',
        ]);
    }
}
