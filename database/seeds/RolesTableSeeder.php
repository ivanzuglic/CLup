<?php

use Illuminate\Database\Seeder;
use App\Roles;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $roles = [
            ['role_name' => 'admin'],
            ['role_name' => 'customer'],
            ['role_name' => 'manager'],
        ];

        foreach ($roles as $role)
            DB::table('roles')->insert($role);
    }
}
