<?php

use Illuminate\Database\Seeder;
use App\WorkingHours;

class WorkingHoursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $working_hours = [
            [
                'working_hours_id' => '1',
                'store_id' => '1',
                'day' => '0',
                'opening_hours' => '08:00',
                'closing_hours' => '17:00',
            ],
            [
                'working_hours_id' => '2',
                'store_id' => '1',
                'day' => '6',
                'opening_hours' => '08:00',
                'closing_hours' => '12:00',
            ]
        ];

//        foreach ($working_hours as $working_hour)
            if (!WorkingHours::find(1))
                DB::table('working_hours')->insert($working_hours[0]);
            if (!WorkingHours::find(2))
                DB::table('working_hours')->insert($working_hours[1]);
    }
}
