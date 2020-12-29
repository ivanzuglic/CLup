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
                'day' => '1',
                'opening_hours' => '08:00',
                'closing_hours' => '17:00',
            ],
            [
                'working_hours_id' => '3',
                'store_id' => '1',
                'day' => '2',
                'opening_hours' => '08:00',
                'closing_hours' => '17:00',
            ],
            [
                'working_hours_id' => '4',
                'store_id' => '1',
                'day' => '3',
                'opening_hours' => '08:00',
                'closing_hours' => '17:00',
            ],
            [
                'working_hours_id' => '5',
                'store_id' => '1',
                'day' => '4',
                'opening_hours' => '08:00',
                'closing_hours' => '12:00',
            ],
            [
                'working_hours_id' => '6',
                'store_id' => '2',
                'day' => '0',
                'opening_hours' => '08:00',
                'closing_hours' => '17:00',
            ],
            [
                'working_hours_id' => '7',
                'store_id' => '2',
                'day' => '1',
                'opening_hours' => '08:00',
                'closing_hours' => '17:00',
            ],
            [
                'working_hours_id' => '8',
                'store_id' => '2',
                'day' => '2',
                'opening_hours' => '08:00',
                'closing_hours' => '17:00',
            ],
            [
                'working_hours_id' => '9',
                'store_id' => '2',
                'day' => '3',
                'opening_hours' => '08:00',
                'closing_hours' => '17:00',
            ],
            [
                'working_hours_id' => '10',
                'store_id' => '2',
                'day' => '4',
                'opening_hours' => '08:00',
                'closing_hours' => '12:00',
            ]
        ];

        foreach ($working_hours as $working_hour)
                DB::table('working_hours')->insert($working_hour);
    }
}
