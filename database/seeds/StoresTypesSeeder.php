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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('stores')->truncate();
        DB::table('store_types')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $types = [
            ['store_type' => 'Market'],
            ['store_type' => 'Pharmacy'],
            ['store_type' => 'Pet Shop'],
            ['store_type' => 'Music Shop'],
            ['store_type' => 'Jewellery Shop'],
            ['store_type' => 'Flower Shop'],
            ['store_type' => 'Butcher'],
            ['store_type' => 'Clothing Shop'],
            ['store_type' => 'Shoe Shop'],
        ];

        foreach ($types as $type)
            DB::table('store_types')->insert($type);
    }
}
