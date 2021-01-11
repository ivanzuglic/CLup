<?php

namespace Tests\Feature;

use App\Store;
use App\User;
use Illuminate\Support\Facades\Gate;
use Mockery;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends BasicFeatureCase
{
    /*
     * tests of this class can be started in two ways:
     * 1) start tests one by one with command: "vendor\bin\phpunit --filter name_of_function" typed into the terminal
     *      e.g. "vendor\bin\phpunit --filter only_logged_in_admin_can_see_admin_dashboard"
     * 2) start all tests in specific Test class with command: "vendor\bin\phpunit --filter NameOfTestClass"
     *      e.g. "vendor\bin\phpunit --filter AdminTest"
     */

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

//        $this->seed();

        Gate::before(function () {
            return true;
        });

    }

    /*************** Add Store view *********************/

    /** @test */
    public function only_logged_in_user_can_see_form_for_adding_stores()
    {
        $this->seed();
        $response = $this->get('/admin/dashboard/add_store')
            ->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_admin_can_see_form_for_adding_stores()
    {
        $this->actingAsAdmin();
        $response = $this->get('/admin/dashboard/add_store')
            ->assertOk();

    }

    /** @test */
    public function authenticated_admin_can_add_a_store_through_the_form()
    {
        //$this->withoutExceptionHandling();

        $this->actingAsAdmin();

        $response = $this->post('/stores', [
            'name' => 'Test Store',
            'description' => 'Whatever',
            'store_type' => '1',
            'image_reference' => '',
            'address_line_1' => 'Test Avenue 2',
            'zip_code' => '20000',
            'town' => 'Test',
            'country' => 'Test',
            'max_occupancy' => '1000',
            'current_occupancy' => '0',
        ]);

        $this->assertCount(7, Store::all());

    }

    /*************** Add Store view *********************/


    /*************** Add Manager view *********************/

    /** @test */
    public function authenticated_admin_can_see_form_for_adding_managers()
    {
        $this->actingAsAdmin();
        $response = $this->get('/admin/dashboard/add_manager')
            ->assertOk();

    }

    /** @test */
    public function only_logged_in_admin_can_see_profile_edit_form()
    {
        $response = $this->get('/profile/edit')
            ->assertRedirect('/login');

    }

    /** @test */
    public function authenticated_admin_can_add_a_manager_through_the_form()
    {
        //$this->withoutExceptionHandling();

        $this->actingAsAdmin();

//        $mock = Mockery::mock('Illuminate\Support\Facades\Gate');
//        $mock->shouldReceive('allows')->with('ManagerRegister')->once()->andReturn(true);
//        $this->app->instance('Illuminate\Support\Facades\Gate', $mock);


        $response = $this->post('/admin/dashboard/add_manager', [
            'name' => 'Test Manager',
            'email' => 'manager@test.com',
            'password' => 'manager123',
            'password_confirmation' => 'manager123',
            'phone_number' => '12345678',
            'store_id' => '5'
        ]);

        $this->assertCount(16, User::all());

    }

    /*************** Add Manager view *********************/


    /*************** Settings view *********************/

    /** @test */
    public function authenticated_admin_can_see_profile_edit_form()
    {
        $this->actingAsAdmin();

        $response = $this->get('/profile/edit')
            ->assertOk();

    }

    /** @test */
    public function only_logged_in_admin_can_update_their_profile_through_form()
    {
        $response = $this->patch('/profile/update', $this->adminData())
            ->assertRedirect('/login');

    }

    /** @test */
    public function authenticated_admin_can_update_their_profile_through_form()
    {
        //$this->withoutExceptionHandling();

        $this->actingAsAdmin();

        $response = $this->patch('/profile/update', $this->adminData())
            ->assertRedirect('/');

    }

    /** @test */
    public function authenticated_admin_can_update_their_password_through_form()
    {
        //$this->withoutExceptionHandling();

        $this->actingAsAdmin();

        $response = $this->patch('/profile/update/password', [
            'password' => 'test321',
            'password_confirmation' => 'test321'
        ])->assertRedirect('/');

    }

    /*************** Settings view *********************/


}
