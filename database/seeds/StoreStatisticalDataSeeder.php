<?php

use Illuminate\Database\Seeder;

class StoreStatisticalDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statistical_data = [
            [
                'store_id' => '1',
                'avg_customers' => '6',
                'avg_time_spent_min' => '16',
                'n_customers' => '123',
                'n_days' => '14',
            ],
            [
                'store_id' => '2',
                'avg_customers' => '9',
                'avg_time_spent_min' => '12',
                'n_customers' => '178',
                'n_days' => '15',
            ],
            [
                'store_id' => '3',
                'avg_customers' => '226',
                'avg_time_spent_min' => '36',
                'n_customers' => '1235',
                'n_days' => '13',
            ],
            [
                'store_id' => '4',
                'avg_customers' => '40',
                'avg_time_spent_min' => '25',
                'n_customers' => '230',
                'n_days' => '15',
            ],
            [
                'store_id' => '5',
                'avg_customers' => '11',
                'avg_time_spent_min' => '16',
                'n_customers' => '650',
                'n_days' => '14',
            ],
            [
                'store_id' => '6',
                'avg_customers' => '36',
                'avg_time_spent_min' => '26',
                'n_customers' => '543',
                'n_days' => '14',
            ]
        ];

        foreach ($statistical_data as $data)
            DB::table('store_statistical_data')->insert($data);
    }
}
