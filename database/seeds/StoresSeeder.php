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
                'image_reference' => '',
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
                'image_reference' => '',
                'address_line_1' => 'MDH',
                'zip_code' => "721 23",
                'town' => "Västerås",
                'country' => 'Sweden',

                'max_occupancy' => '20',
                'current_occupancy' => '0',
            ],
            [
                'name' => 'Best Supermarket',
                'description' => 'In whole world',
                'store_type' => '1',
                'image_reference' => '',
                'address_line_1' => 'Alpha Supermarket Avenue 2',
                'zip_code' => "20000",
                'town' => "London",
                'country' => 'Alpha',

                'max_occupancy' => '1000',
                'current_occupancy' => '800',
            ],

            [
                'name' => 'Pharmacy AAP',
                'description' => 'All kinds of drugs',
                'store_type' => '2',
                'image_reference' => '',
                'address_line_1' => 'Alpha Apothecary Avenue 41',
                'zip_code' => "50000",
                'town' => "Vladivostok",
                'country' => 'Alpha',

                'max_occupancy' => '90',
                'current_occupancy' => '2',
            ],
            [
                'name' => 'Best Served Cold',
                'description' => 'Only one on whole continent',
                'store_type' => '1',
                'image_reference' => '',
                'address_line_1' => 'Frozen way 3',
                'zip_code' => "30000",
                'town' => "McMurdo Base Antarctica",
                'country' => 'Antarctica',

                'max_occupancy' => '20',
                'current_occupancy' => '15',
            ],
            [
                'name' => 'Big Bad Store',
                'description' => 'I do not want to put image',
                'store_type' => '1',
                'image_reference' => '',
                'address_line_1' => 'Alpha Supermarket Avenue 4',
                'zip_code' => "20000",
                'town' => "London",
                'country' => 'Alpha',

                'max_occupancy' => '100',
                'current_occupancy' => '0',
            ]

        ];

        foreach ($stores as $store)
            DB::table('stores')->insert($store);
    }
}
