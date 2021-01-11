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
                'store_id' => '1',
                'day' => '0',
                'opening_hours' => '08:00',
                'closing_hours' => '22:00',
            ],
            [
                'store_id' => '1',
                'day' => '1',
                'opening_hours' => '08:00',
                'closing_hours' => '22:00',
            ],
            [
                'store_id' => '1',
                'day' => '2',
                'opening_hours' => '08:00',
                'closing_hours' => '22:00',
            ],
            [
                'store_id' => '1',
                'day' => '3',
                'opening_hours' => '08:00',
                'closing_hours' => '22:00',
            ],
            [
                'store_id' => '1',
                'day' => '4',
                'opening_hours' => '08:00',
                'closing_hours' => '22:00',
            ],
            [
                'store_id' => '1',
                'day' => '5',
                'opening_hours' => '08:00',
                'closing_hours' => '22:00',
            ],
            [
                'store_id' => '1',
                'day' => '6',
                'opening_hours' => '08:00',
                'closing_hours' => '22:00',
            ],
            [
                'store_id' => '2',
                'day' => '0',
                'opening_hours' => '08:00',
                'closing_hours' => '22:00',
            ],
            [
                'store_id' => '2',
                'day' => '1',
                'opening_hours' => '08:00',
                'closing_hours' => '22:00',
            ],
            [
                'store_id' => '2',
                'day' => '2',
                'opening_hours' => '08:00',
                'closing_hours' => '22:00',
            ],
            [
                'store_id' => '2',
                'day' => '3',
                'opening_hours' => '08:00',
                'closing_hours' => '22:00',
            ],
            [
                'store_id' => '2',
                'day' => '4',
                'opening_hours' => '08:00',
                'closing_hours' => '22:00',
            ],
            [
                'store_id' => '2',
                'day' => '5',
                'opening_hours' => '08:00',
                'closing_hours' => '23:00',
            ],
            [
                'store_id' => '2',
                'day' => '6',
                'opening_hours' => '08:00',
                'closing_hours' => '22:00',
            ]
        ];

        foreach ($working_hours as $working_hour)
                DB::table('working_hours')->insert($working_hour);
    }
}
