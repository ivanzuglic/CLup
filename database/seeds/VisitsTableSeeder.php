<?php

use Illuminate\Database\Seeder;

class VisitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $visits = [
            [
                'store_id' => '1',
                'enter_time' => '10:00',
                'exit_time' => '10:20',
                'date' => date("Y-m-d", strtotime("-1 day")),
            ],
            [
                'store_id' => '1',
                'enter_time' => '11:00',
                'exit_time' => '11:20',
                'date' => date("Y-m-d", strtotime("-1 day")),
            ],
            [
                'store_id' => '1',
                'enter_time' => '12:00',
                'exit_time' => '12:20',
                'date' => date("Y-m-d", strtotime("-1 day")),
            ],
            [
                'store_id' => '1',
                'enter_time' => '10:00',
                'exit_time' => '10:20',
                'date' => date("Y-m-d", strtotime("-1 day")),
            ],
        ];

        foreach ($visits as $visit)
            DB::table('visits')->insert($visit);
    }
}
