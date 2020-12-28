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
            ],
            [
                'name' => 'MDH_manager',
                'email' => 'MDHmanager@gmail.com',
                'password' => Hash::make('manager123'),
                'phone_number' => '0995130322',
                'role_id' => '3',
                'store_id' => '2'
            ],
            [
                'name' => 'Best_Supermarket_manager',
                'email' => 'BSmanager@gmail.com',
                'password' => Hash::make('manager123'),
                'phone_number' => '0995130322',
                'role_id' => '3',
                'store_id' => '3'
            ],
            [
                'name' => 'Pharmacy AAP_manager',
                'email' => 'Pharmacymanager@gmail.com',
                'password' => Hash::make('manager123'),
                'phone_number' => '0995130322',
                'role_id' => '3',
                'store_id' => '4'
            ],
            [
                'name' => 'Best Served Cold_manager',
                'email' => 'BSColdmanager@gmail.com',
                'password' => Hash::make('manager123'),
                'phone_number' => '0995130322',
                'role_id' => '3',
                'store_id' => '5'
            ],
            [
                'name' => 'Big Bad Store_manager',
                'email' => 'BigBadStoremanager@gmail.com',
                'password' => Hash::make('manager123'),
                'phone_number' => '0995130322',
                'role_id' => '3',
                'store_id' => '6'
            ],

        ];

        foreach ($managers as $manager)
            if (User::where('email', $manager['email'])->first() == null)
                DB::table('users')->insert($manager);
    }
}
