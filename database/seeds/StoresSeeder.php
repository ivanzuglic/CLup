<?php

use Illuminate\Database\Seeder;

class StoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stores = [
            [
                'name' => 'Clup_store_FER',
                'description' => 'Come Come',
                'store_type' => '1',

                'address_line_1' => 'FER',
                'zip_code' => "10000",
                'town' => "Zagreb",
                'country' => 'Croatia',

                'max_occupancy' => '10',
                'current_occupancy' => '0',
            ],
            [
                'name' => 'Clup_store_MDH',
                'description' => 'Come Come',
                'store_type' => '2',

                'address_line_1' => 'MDH',
                'zip_code' => "721 23",
                'town' => "Västerås",
                'country' => 'Sweden',

                'max_occupancy' => '20',
                'current_occupancy' => '0',
            ]
        ];

        foreach ($stores as $store)
            DB::table('stores')->insert($store);
    }
}
