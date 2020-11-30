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
                'image_reference' => 'https://repozitorij.fer.unizg.hr/sites/repozitorij.fer.unizg.hr/files/fer_logo_1.jpg',
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
                'image_reference' => 'https://www.eduopinions.com/wp-content/uploads/2018/03/M%C3%A4lardalen-University-logo.jpg',
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
                'image_reference' => 'https://clipartstation.com/wp-content/uploads/2017/11/supermarket-building-clipart.gif',
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
                'image_reference' => 'https://image.freepik.com/free-vector/pharmacy-building-big-city-vector-illustration_61747-290.jpg',
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
                'image_reference' => 'https://compote.slate.com/images/511985a0-36fd-450a-a6f5-59a53899cab3.jpg',
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
