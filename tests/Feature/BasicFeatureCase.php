<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BasicFeatureCase extends TestCase
{
    /*
     * This class contains protected functions used by other Feature tests.
     * To start all Feature tests, type command: "vendor\bin\phpunit --testsuite Feature"
     *
     */


    /*
     * Customer functions
     */

    protected function actingAsCustomer()
    {
        $this->actingAs(factory(User::class)->create([
            'role_id' => '2',
        ]));
    }

    protected function makeCustomer()
    {
        return factory(User::class)->create([
            'role_id' => '2'
        ]);
    }

//   Function that returns customer data that we want to edit
    protected function customerData()
    {
        return [
            'name' => 'Test Customer',
            'email' => 'test@test.com',
            'phone_number' => '87654321'
        ];
    }


    /*
     * Manager functions
     */

    protected function actingAsManager()
    {
        $this->actingAs(factory(User::class)->create([
            'name' => 'Test Manager',
            'email' => 'manager@test.com',
            'role_id' => '3',
            'store_id' => '2'
        ]));
    }

    protected function actingAsManager2()
    {
        $this->actingAs(factory(User::class)->create([
            'name' => 'Test Manager',
            'email' => 'manager@test.com',
            'role_id' => '3',
            'store_id' => '3'
        ]));
    }

    protected function makeManager()
    {
        return factory(User::class)->create([
            'name' => 'Test Manager',
            'email' => 'manager@test.com',
            'role_id' => '3',
            'store_id' => '2'
        ]);
    }

//   Function that returns manager data that we want to edit
    protected function managerData()
    {
        return [
            'name' => 'Test Manager Changed',
            'email' => 'manager@changed.com',
            'phone_number' => '87654321'
        ];
    }


    /*
     * Admin functions
     */

    protected function actingAsAdmin()
    {
        $this->actingAs(factory(User::class)->create([
            'name' => 'Test Admin',
            'email' => 'admin@test.com',
            'role_id' => '1',
        ]));
    }


//   Function that returns admin data that we want to edit
    protected function adminData()
    {
        return [
            'name' => 'Test Admin Changed',
            'email' => 'admin@changed.com',
            'phone_number' => '87654321'
        ];
    }
}
