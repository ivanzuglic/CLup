<?php

namespace Tests\Feature;

use App\Store;
use App\User;
use App\WorkingHours;
use App\Appointment;
use phpDocumentor\Reflection\Types\Null_;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManagerTest extends BasicFeatureCase
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

//        $this->seed();

    }


    /*************** Settings view *********************/

    /** @test */
    public function only_logged_in_manager_can_see_profile_edit_form()
    {
//        $this->seed();
        $response = $this->get('/profile/edit')
            ->assertRedirect('/login');

    }

    /** @test */
    public function authenticated_manager_can_see_profile_edit_form()
    {
        $this->actingAsManager();

        $response = $this->get('/profile/edit')
            ->assertOk();

    }

    /** @test */
    public function only_logged_in_manager_can_update_their_profile_through_form()
    {
        $response = $this->patch('/profile/update', $this->managerData())
            ->assertRedirect('/login');

    }

    /** @test */
    public function authenticated_manager_can_update_their_profile_through_form()
    {
        //$this->withoutExceptionHandling();

        $this->actingAsManager();

        $response = $this->patch('/profile/update', $this->managerData())
            ->assertRedirect('/');

    }

    /** @test */
    public function authenticated_manager_can_update_their_password_through_form()
    {
        //$this->withoutExceptionHandling();

        $this->actingAsManager();

        $response = $this->patch('/profile/update/password', [
            'password' => 'test321',
            'password_confirmation' => 'test321'
        ])->assertRedirect('/');

    }

    /*************** Settings view *********************/


    /*************** Store parameters view *********************/

    /** @test */
    public function only_logged_in_user_can_see_store_parameters()
    {
        $response = $this->get('/manager/dashboard/store_parameters/1')
            ->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_manager_can_see_store_parameters()
    {
        // $this->withoutExceptionHandling();
        $this->user = $this->makeManager();
        $response = $this->actingAs($this->user)->get('/manager/dashboard/store_parameters/' . $this->user->store_id . '')
            ->assertOk();

    }

    /** @test */
    public function authenticated_manager_can_change_parameters_of_their_store()
    {
//        $this->withoutExceptionHandling();

        $this->user = $this->makeManager();

        $response = $this->actingAs($this->user)->patch(route('parameters.update', [
            'store_id' => $this->user->store_id,
            'max_occupancy' => '40',
            'max_reservation_ratio' => '0.5',
            'image_reference' => '/test'
        ]));
        // there can be full route path (like in test above this one) instead of short one,
        // but then store_id should be concatenated into the path instead of being sent with other parameters,
        // as in assertRedirect() of authenticated_manager_can_see_ticket_pdf_of_proxy_user()

        $response->assertRedirect('/');

    }

    /** @test */
    public function authenticated_manager_can_change_work_hours_of_their_store()
    {
//        $this->withoutExceptionHandling();

        $this->user = $this->makeManager();

        $response = $this->actingAs($this->user)->post(route('working_hours.update', [
            'store_id' => $this->user->store_id,
            'day' => '2',
            'opening_hours' => '08:00',
            'closing_hours' => '17:00'
        ]));
        $response->assertRedirect('/');
//        $this->assertCount(3, WorkingHours::all());

    }

    /*************** Store Parameters view *********************/


    /*************** Print Tickets view *********************/

    /** @test */
    public function only_logged_in_manager_can_see_print_ticket_form()
    {
        $response = $this->get('/manager/dashboard/print_tickets/1')
            ->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_manager_can_add_proxy_user_to_queue()
    {
        $this->withoutExceptionHandling();

        $this->user = $this->makeManager();

        $response = $this->actingAs($this->user)->post(route('appointment.addQueueProxy', [
            'store_id' => $this->user->store_id,
            'planned_stay_time' => 10
        ]));

        $this->assertCount(8, Appointment::all());

    }

    /** @test */
    public function authenticated_manager_can_see_ticket_pdf_of_proxy_user()
    {
//        $this->withoutExceptionHandling();

        $this->user = $this->makeManager();

        $response = $this->actingAs($this->user)->post(route('appointment.addQueueProxy', [
            'store_id' => $this->user->store_id,
            'planned_stay_time' => 10
        ]));

        $appointment = Appointment::where('user_id', null)->where('store_id', $this->user->store_id)->first();

        $response->assertRedirect('/appointments/' . $appointment->appointment_id . '/pdf');
    }

    /*************** Print Tickets view *********************/

    /*************** Store Statistics view *********************/

    /** @test */
    public function only_logged_in_user_can_see_store_statistics()
    {
        $response = $this->get('/manager/dashboard/store_statistics/1')
            ->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_manager_can_see_store_statistics()
    {
        // $this->withoutExceptionHandling();
        $this->user = $this->makeManager();
        $response = $this->actingAs($this->user)->get('/manager/dashboard/store_statistics/' . $this->user->store_id . '')
            ->assertOk();

    }

    /*************** Store Statistics view *********************/

}
