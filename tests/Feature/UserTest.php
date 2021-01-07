<?php

namespace Tests\Feature;

use App\Appointment;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends BasicFeatureCase
{
    /*
     * tests of this class can be started in two ways:
     * 1) start tests one by one with command: "vendor\bin\phpunit --filter name_of_function" typed into the terminal
     *      e.g. "vendor\bin\phpunit --filter only_logged_in_customer_can_see_home_page"
     * 2) start all tests in specific Test class with command: "vendor\bin\phpunit --filter NameOfTestClass"
     *      e.g. "vendor\bin\phpunit --filter UserTest"
     */
    use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();

//        $this->seed();

    }

    /** @test */
    public function user_can_see_login_page()
    {
        $this->seed();
        $response = $this->get('/login');
        $response->assertStatus(200);
    }


    /** @test */
    public function only_logged_in_customer_can_see_home_page()
    {
        $response = $this->get('/home')
            ->assertRedirect('/login');

    }

    /** @test */
    public function authenticated_customer_can_see_store_list()
    {
        $this->actingAsCustomer();
        $response = $this->get('/home')
            ->assertOk();

    }

    /** @test */
    public function only_logged_in_customer_can_see_profile_edit_form()
    {
        $response = $this->get('/profile/edit')
            ->assertRedirect('/login');

    }

    /** @test */
    public function authenticated_customer_can_see_profile_edit_form()
    {
        $this->actingAsCustomer();

        $response = $this->get('/profile/edit')
            ->assertOk();

    }

    /** @test */
    public function only_logged_in_customer_can_update_their_profile_through_form()
    {
        $response = $this->patch('/profile/update', $this->customerData())
            ->assertRedirect('/login');

    }

    /** @test */
    public function authenticated_customer_can_update_their_profile_through_form()
    {
        //$this->withoutExceptionHandling();

        $this->actingAsCustomer();

        $response = $this->patch('/profile/update', $this->customerData())
            ->assertRedirect('/');

        //  $this->assertCount(3, User::all());

    }

    /** @test */
    public function authenticated_customer_can_update_their_password_through_form()
    {
        //$this->withoutExceptionHandling();    // use when you want more details of error (when test fails)

        $this->actingAsCustomer();

        $response = $this->patch('/profile/update/password', [
            'password' => 'test321',
            'password_confirmation' => 'test321'
        ])->assertRedirect('/');

        //  $this->assertCount(3, User::all());

    }

    /** @test */
    public function only_logged_in_customer_can_see_placements_list()
    {
        $response = $this->get('/user/10/placements')
            ->assertRedirect('/login');

    }

    /** @test */
    public function authenticated_customer_can_see_their_placements()
    {
//        $this->withoutExceptionHandling();

        $this->user = $this->makeCustomer();
        $response = $this->actingAs($this->user)->get('/user/' . $this->user->id . '/placements')
            ->assertOk();

    }

    /** @test */
    public function authenticated_customer_can_search_stores()
    {
//        $this->withoutExceptionHandling();

        $this->user = $this->makeCustomer();
        $searchString = 'Clup';
        $response = $this->actingAs($this->user)->get('/home/search')
            ->assertOk();
        $response = $this->actingAs($this->user)->get('/home/search?search_string' . $searchString . '')
            ->assertOk();
    }

    /** @test */
    public function authenticated_customer_can_view_details_of_specific_store()
    {
//        $this->withoutExceptionHandling();

        $this->user = $this->makeCustomer();
        $response = $this->actingAs($this->user)->get('/store/1/details')
            ->assertOk();

    }

    /** @test */
    public function authenticated_customer_can_queue_up_in_specific_store()
    {
//        $this->withoutExceptionHandling();

        $this->user = $this->makeCustomer();

        $response = $this->actingAs($this->user)->post('/appointments/queue', [
            'store_id' => 2,
            'travel_time' => 10,
            'planned_stay_time' => 20
        ]);
        $response->assertRedirect('/user/' . $this->user->id . '/placements');
        $this->assertCount(6, Appointment::all());
    }

    /** @test */
    public function authenticated_customer_can_book_a_timeslot_in_specific_store()
    {
//        $this->withoutExceptionHandling();

        $this->user = $this->makeCustomer();

        $response = $this->actingAs($this->user)->post('/appointments/reservations', [
            'store_id' => 2,
            'reservation_date' => '2021-01-21',
            'reservation_start_time' => '13:00',
            'reservation_end_time' => '13:30'
        ]);
        $response->assertRedirect('/user/' . $this->user->id . '/placements');
        $this->assertCount(6, Appointment::all());
    }

    /*
     *  Tests for validations
     *
     */
    /** @test */
    public function a_name_is_required()
    {
        //$this->withoutExceptionHandling();

        $this->actingAsCustomer();

        $response = $this->patch('/profile/update', array_merge($this->customerData(), ['name' => '']));
        $response->assertSessionHasErrors('name');
    }


    /** @test */
    public function an_email_is_required()
    {
        //$this->withoutExceptionHandling();

        $this->actingAsCustomer();

        $response = $this->patch('/profile/update', array_merge($this->customerData(), ['email' => '']));
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function a_valid_email_is_required()
    {
        //$this->withoutExceptionHandling();

        $this->actingAsCustomer();

        $response = $this->patch('/profile/update', array_merge($this->customerData(), ['email' => 'test_test']));
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function a_phone_number_is_required()
    {
        //$this->withoutExceptionHandling();

        $this->actingAsCustomer();

        $response = $this->patch('/profile/update', array_merge($this->customerData(), ['phone_number' => '']));
        $response->assertSessionHasErrors('phone_number');
    }

    /** @test */
    public function a_phone_number_must_be_at_least_8_characters()
    {
        //$this->withoutExceptionHandling();

        $this->actingAsCustomer();

        $response = $this->patch('/profile/update', array_merge($this->customerData(), ['phone_number' => '123']));
        $response->assertSessionHasErrors('phone_number');
    }

    /** @test */
    public function a_phone_number_must_be_max_16_characters()
    {
        //$this->withoutExceptionHandling();

        $this->actingAsCustomer();

        $response = $this->patch('/profile/update', array_merge($this->customerData(), ['phone_number' => '12345678901234567']));
        $response->assertSessionHasErrors('phone_number');
    }

    /** @test */
    public function a_password_must_be_at_least_6_characters_and_confirmed()
    {
        //$this->withoutExceptionHandling();

        $this->actingAsCustomer();
        $response = $this->patch('/profile/update/password', [
            'password' => 'test32',
            'password_confirmation' => 'test3'
        ]);
        $response->assertSessionHasErrors('password');                  // throws errors (password not long enough)
        $response->assertSessionHasErrors('password_confirmation');     // throws errors (password not confirmed)

    }


}
