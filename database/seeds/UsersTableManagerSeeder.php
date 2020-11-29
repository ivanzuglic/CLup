<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $managers = [
            [
                'name' => 'clupstore_manager',
                'email' => 'manager@gmail.com',
                'password' => Hash::make('manager123'),
                'phone_number' => '0995130322',
                'role_id' => '3',
                'store_id' => '1'
            ]
        ];

        foreach ($managers as $manager)
            if (User::where('email', $manager['email'])->first() == null)
                DB::table('users')->insert($manager);
    }
}
