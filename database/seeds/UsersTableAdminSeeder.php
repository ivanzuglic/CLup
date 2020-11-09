<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin_test',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'phone_number' => '1234567890',
            'role_id' => '1'
        ]);
    }
}
