<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'name' => 'admin_test',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'phone_number' => '1234567890',
                'role_id' => '1'
            ]
        ];

        foreach ($admins as $admin)
            if (User::where('email', $admin['email'])->first() == null)
                DB::table('users')->insert($admin);
    }
}
