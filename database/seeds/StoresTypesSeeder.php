<?php

use Illuminate\Database\Seeder;

class StoresTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('store_types')->insert([
            'store_type' => 'Market',
        ]);
        DB::table('store_types')->insert([
            'store_type' => 'Pharmacy',
        ]);
    }
}
