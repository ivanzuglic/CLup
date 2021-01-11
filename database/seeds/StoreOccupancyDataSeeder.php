<?php

use Illuminate\Database\Seeder;

class StoreOccupancyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $occupancy_data = [
            [
                'store_id' => 1,
                'array_customer_density' =>
                    '[0, 0, 0, 0, 0, 0,
                        0, 0, 0, 2, 10, 0,
                        0, 4, 5, 3, 10, 0,
                        0, 0, 0, 0, 0, 0]'
            ],
            [
                'store_id' => '2',
                'array_customer_density' =>
                    '[0, 0, 0, 0, 0, 0,
                        4, 2, 5, 4, 5, 6,
                        7, 1, 9, 3, 5, 6,
                        2, 3, 4, 6, 2, 1]'
            ],
            [
                'store_id' => '3',
                'array_customer_density' =>
                    '[0, 0, 0, 0, 0, 0,
                        11, 12, 203, 424, 125, 136,
                        127, 82, 92, 105, 813, 651,
                        172, 173, 114, 111, 122, 21]'
            ],
            [
                'store_id' => '4',
                'array_customer_density' =>
                    '[0, 0, 0, 0, 0, 0,
                        41, 22, 15, 14, 15,16,
                        7, 11, 29, 13, 15, 16,
                        12, 13, 24, 6, 2, 1]'
            ],
            [
                'store_id' => '5',
                'array_customer_density' =>
                   '[0, 0, 0, 0, 0, 0,
                        11, 12, 15, 14, 15,16,
                        7, 11, 9, 13, 15, 16,
                        12, 13, 14, 6, 2, 1]'
            ],
            [
                'store_id' => '6',
                'array_customer_density' =>
                    '[0, 0, 0, 0, 0, 0,
                        41, 22, 15, 14, 15,16,
                        7, 11, 29, 13, 15, 16,
                        12, 13, 24, 6, 2, 1]'
            ]
        ];

        foreach ($occupancy_data as $data)
            DB::table('store_occupancy_data')->insert($data);
    }
}
