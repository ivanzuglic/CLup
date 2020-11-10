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
        DB::table('stores')->insert([
            'name' => 'Clup_store',
            'description' => 'Come Come',
            'store_type' => '1',
            'address' => 'MDH and FER',
            'max_occupancy' => '10',
            'current_occupancy' => '0',
        ]);
    }
}
