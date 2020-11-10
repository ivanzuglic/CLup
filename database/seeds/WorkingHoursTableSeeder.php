<?php

use Illuminate\Database\Seeder;

class WorkingHoursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('working_hours')->insert([
            'working_hours_id' => '1',
            'store_id' => '1',
            'day' => '0',
            'opening_hours' => '08:00',
            'closing_hours' => '17:00',
        ]);

        DB::table('working_hours')->insert([
            'working_hours_id' => '2',
            'store_id' => '1',
            'day' => '6',
            'opening_hours' => '08:00',
            'closing_hours' => '12:00',
        ]);
    }
}
