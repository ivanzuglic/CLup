<?php

use Illuminate\Database\Seeder;

class UsersTableManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'clupstore_manager',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('manager123'),
            'phone_number' => '0995130322',
            'role_id' => '3',
            'store_id' => '1'
        ]);
    }
}
