<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Tamara',
                'email' => 'tamara@gmail.com',
                'password' => Hash::make('user123'),
                'phone_number' => '1234567890',
                'role_id' => '2'
            ],
            [
                'name' => 'Kejsi',
                'email' => 'Kejsi@gmail.com',
                'password' => Hash::make('user123'),
                'phone_number' => '1234567890',
                'role_id' => '2'
            ],
            [
                'name' => 'Gerald',
                'email' => 'Gerald@gmail.com',
                'password' => Hash::make('user123'),
                'phone_number' => '1234567890',
                'role_id' => '2'
            ],
            [
                'name' => 'Luka',
                'email' => 'Luka@gmail.com',
                'password' => Hash::make('user123'),
                'phone_number' => '1234567890',
                'role_id' => '2'
            ],
            [
                'name' => 'Toni',
                'email' => 'Toni@gmail.com',
                'password' => Hash::make('user123'),
                'phone_number' => '1234567890',
                'role_id' => '2'
            ],
            [
                'name' => 'Ivan',
                'email' => 'Ivan@gmail.com',
                'password' => Hash::make('user123'),
                'phone_number' => '1234567890',
                'role_id' => '2'
            ],
            [
                'name' => 'Josip',
                'email' => 'Josip@gmail.com',
                'password' => Hash::make('user123'),
                'phone_number' => '1234567890',
                'role_id' => '2'
            ]
        ];

        foreach ($users as $user)
            if (User::where('email', $user['email'])->first() == null)
                DB::table('users')->insert($user);
    }
}
