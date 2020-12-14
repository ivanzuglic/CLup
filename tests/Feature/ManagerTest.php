<?php

namespace Tests\Feature;

use App\User;
use App\WorkingHours;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManagerTest extends TestCase
{
    /*
     * tests of this class can be started in two ways:
     * 1) start tests one by one with command: "vendor\bin\phpunit --filter name_of_function" typed into the terminal
     *      e.g. "vendor\bin\phpunit --filter only_logged_in_user_can_see_manager_dashboard"
     * 2) start all tests in specific Test class with command: "vendor\bin\phpunit --filter NameOfTestClass"
     *      e.g. "vendor\bin\phpunit --filter ManagerTest"
 */

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

    }


    /** @test */
    public function only_logged_in_user_can_see_manager_dashboard()
    {
        $response = $this->get('/manager/dashboard')
            ->assertRedirect('/login');
    }


    /** @test */
    public function authenticated_manager_can_see_manager_dashboard()
    {
        // $this->withoutExceptionHandling();
        $this->actingAsManager();
        $response = $this->get('/manager/dashboard')
            ->assertOk();

    }

    /** @test */
    public function only_logged_in_admin_can_see_edit_form()
    {
        $response = $this->get('/user_profile/edit')
            ->assertRedirect('/login');

    }

    /** @test */
    public function authenticated_admin_can_see_edit_form()
    {
        $this->actingAsManager();

        $response = $this->get('/user_profile/edit')
            ->assertOk();

    }

    /** @test */
    public function only_logged_in_manager_can_update_their_profile_through_form()
    {
        $response = $this->patch('/user_profile/update', $this->managerData())
            ->assertRedirect('/login');

    }

    /** @test */
    public function authenticated_manager_can_update_their_profile_through_form()
    {
        //$this->withoutExceptionHandling();

        $this->actingAsManager();

        $response = $this->patch('/user_profile/update', $this->managerData())
            ->assertRedirect('/');

    }

    /** @test */
    public function authenticated_manager_can_update_their_password_through_form()
    {
        //$this->withoutExceptionHandling();

        $this->actingAsManager();

        $response = $this->patch('/user_profile/update/pass', [
            'password' => 'test321',
            'password_confirmation' => 'test321'
        ])->assertRedirect('/');

    }

    /** @test */
    public function authenticated_manager_can_change_parameters_of_their_store()
    {
//        $this->withoutExceptionHandling();

        $this->user = $this->makeManager();

        $response = $this->actingAs($this->user)->patch(route('stores.update', [
            'store_id' => $this->user->store_id,
            'max_occupancy' => '40',
            'max_reservation_ratio' => '0.5',
            'image_reference' => '/test'
        ]));
        $response->assertRedirect('/');

    }

    /** @test */
    public function authenticated_manager_can_change_work_hours_of_their_store()
    {
//        $this->withoutExceptionHandling();

        $this->user = $this->makeManager();

        $response = $this->actingAs($this->user)->post(route('working_hours.bulk_CUD', [
            'store_id' => $this->user->store_id,
            'day' => '2',
            'opening_hours' => '08:00',
            'closing_hours' => '17:00'
        ]));
        $response->assertRedirect('/');
//        $this->assertCount(3, WorkingHours::all());

    }



    /*
     * Private functions
     */

    private function actingAsManager()
    {
        $this->actingAs(factory(User::class)->create([
            'name' => 'Test Manager',
            'email' => 'manager@test.com',
            'role_id' => '3',
            'store_id' => '5'
        ]));
    }

    private function makeManager()
    {
        return factory(User::class)->create([
            'name' => 'Test Manager',
            'email' => 'manager@test.com',
            'role_id' => '3',
            'store_id' => '5'
        ]);
    }

    /*
     * Function that returns data that we want to edit
     */
    private function managerData()
    {
        return [
            'name' => 'Test Manager Changed',
            'email' => 'manager@changed.com',
            'phone_number' => '87654321'
        ];
    }

}
