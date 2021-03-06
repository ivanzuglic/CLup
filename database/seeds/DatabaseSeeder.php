<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(RolesTableSeeder::class);
         $this->call(StoresTypesSeeder::class);
         $this->call(AppointmentTypesSeeder::class);
         $this->call(UsersTableAdminSeeder::class);
         $this->call(UsersTableManagerSeeder::class);
         $this->call(UserSeeder::class);
         $this->call(StoresSeeder::class);
         $this->call(StoreStatisticalDataSeeder::class);
         $this->call(StoreOccupancyDataSeeder::class);
//         $this->call(VisitsTableSeeder::class);
         $this->call(WorkingHoursTableSeeder::class);
         $this->call(AppointmentsTableSeeder::class);
    }
}
