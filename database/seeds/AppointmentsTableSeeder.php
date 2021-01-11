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
            'active' => '1',
            'lane' => '1',
            'date' => date("Y-m-d", strtotime("+2 day")),
        ]);

        //Added for overlapping appointments test
        DB::table('appointments')->insert([
            'user_id' => '2',
            'store_id' => '1',
            'appointment_type' => '1',
            'start_time' => '11:00',
            'end_time' => '13:00',
            'active' => '1',
            'lane' => '1',
            'date' => date("Y-m-d", strtotime("+1 day")),
        ]);
        DB::table('appointments')->insert([
            'user_id' => '2',
            'store_id' => '1',
            'appointment_type' => '1',
            'start_time' => '12:30',
            'end_time' => '12:45',
            'active' => '1',
            'lane' => '2',
            'date' => date("Y-m-d", strtotime("+1 day")),
        ]);
        DB::table('appointments')->insert([
            'user_id' => '2',
            'store_id' => '1',
            'appointment_type' => '1',
            'start_time' => '11:00',
            'end_time' => '12:30',
            'active' => '1',
            'lane' => '3',
            'date' => date("Y-m-d", strtotime("+1 day")),
        ]);
        DB::table('appointments')->insert([
            'user_id' => '2',
            'store_id' => '1',
            'appointment_type' => '1',
            'start_time' => '12:40',
            'end_time' => '13:30',
            'active' => '1',
            'lane' => '4',
            'date' => date("Y-m-d", strtotime("+1 day")),
        ]);
        DB::table('appointments')->insert([
            'store_id' => 1,
            'appointment_type' => 3,
            'start_time' => date("H:i:s", strtotime("+10 minute")),
            'end_time' => date("H:i:s", strtotime("+20 minute")),
            'lane' => '1',
            'active' => 1,
            'date' => date("Y-m-d", strtotime("+0 day")),
        ]);
        DB::table('appointments')->insert([
            'store_id' => 1,
            'appointment_type' => 1,
            'start_time' => date("H:i:s", strtotime("+0 minute")),
            'end_time' => date("H:i:s", strtotime("+10 minute")),
            'lane' => '1',
            'active' => 0,
            'date' => date("Y-m-d", strtotime("+0 day")),
        ]);
    }
}
