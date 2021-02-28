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
//        $this->seed();
        $response = $this->get('/login');
        $response->assertStatus(200);
    }



    /*************** Home and Search stores views ******************/

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
    /*************** Home and Search stores views ****************/


    /*************** Settings view *********************/

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

    /*************** Settings view ******************/


    /*************** Store details view *************/

    /** @test */
    public function authenticated_customer_can_view_details_of_specific_store()
    {
//        $this->withoutExceptionHandling();

        $this->user = $this->makeCustomer();
        $response = $this->actingAs($this->user)->get('/store/1/details')
            ->assertOk();

    }

    /** @test */
    public function authenticated_customer_can_exit_store()
    {
//        $this->withoutExceptionHandling();
//        $this->seed();
        $appointment = Appointment::where('appointment_id', 1)->first();
        $appointment->status = 'in store';
        $appointment->save();

        $new_appointment = [
            'user_id' => 10,
            'store_id' => 1,
            'appointment_type' => '2',
            'start_time' => '09:10',
            'end_time' => '10:10',
            'date' => date("Y-m-d", strtotime("+2 day")),
            'status' => 'waiting',
            'active' => '1',
            'lane' => '1',
        ];

        $created_appointment = Appointment::create($new_appointment);
        $response = app('App\Http\Controllers\Appointment\AppointmentController')->scan($appointment->appointment_id);

        Appointment::where('appointment_id', $created_appointment->appointment_id)->delete();

        $this->assertEquals('in store', $appointment->status);


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
        $this->assertCount(8, Appointment::all());
    }

    /** @test */
    public function authenticated_customer_can_book_a_timeslot_in_specific_store()
    {
//        $this->withoutExceptionHandling();

        $this->user = $this->makeCustomer();

        $response = $this->actingAs($this->user)->post('/appointments/reservations', [
            'store_id' => 2,
            'reservation_date' => '2021-03-21',
            'reservation_start_time' => '13:00',
            'reservation_end_time' => '13:30'
        ]);
        $response->assertRedirect('/user/' . $this->user->id . '/placements');
        $this->assertCount(8, Appointment::all());
    }

    /*************** Store details view ******************/


    /*************** My placements view ******************/

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
//        $this->seed();

        $this->user1 = $this->makeCustomer();
        $this->user2 = $this->makeCustomer();

        $response = $this->actingAs($this->user1)->get('/user/' . $this->user1->id . '/placements')
            ->assertOk();

        $response = $this->actingAs($this->user1)->get('/user/' . $this->user2->id . '/placements')
            ->assertRedirect('/user/' . $this->user1->id . '/placements');

    }

    /** @test */
    public function authenticated_customer_can_view_details_of_their_reservation_appointment()
    {
//        $this->withoutExceptionHandling();
//        $this->seed();

        $this->user = $this->makeCustomer();

        // creating new reservation appointment to be able to test it
        $response = $this->actingAs($this->user)->post('/appointments/reservations', [
            'store_id' => 2,
            'reservation_date' => '2021-03-21',
            'reservation_start_time' => '13:00',
            'reservation_end_time' => '13:30'
        ]);

        // getting appointment_id of previously created reservation appointment
        $appointment = Appointment::where('user_id', $this->user->id)->where('active', 1)->where('appointment_type', 1)->first();
        $appointment_id = $appointment->appointment_id;

        $response = $this->actingAs($this->user)->get('appointments/' . $appointment_id . '/details')
            ->assertOk();

    }

    /** @test */
    public function authenticated_customer_can_delete_their_reservation_appointment()
    {
//        $this->withoutExceptionHandling();
//        $this->seed();

        $this->user = $this->makeCustomer();

        // creating new reservation appointment to be able to test it
        $response = $this->actingAs($this->user)->post('/appointments/reservations', [
            'store_id' => 1,
            'reservation_date' => date("Y-m-d", strtotime("+0 day")),
            'reservation_start_time' => date("H:i:s"),
            'reservation_end_time' => date("H:i:s", strtotime("+10 minute"))
        ]);

        // getting appointment_id of previously created reservation appointment
        $appointment = Appointment::where('user_id', $this->user->id)->where('active', 1)->where('appointment_type', 1)->first();
        $appointment_id = $appointment->appointment_id;

        // checks if deletion redirects to needed view
        $response = $this->actingAs($this->user)->patch('/appointments/reservations/' . $appointment_id . '')
            ->assertRedirect('/');

        // checks if queue appointment is updated (deleted) by checking if 'active' was set to 0
        $appointment_after = Appointment::where('user_id', $this->user->id)->where('appointment_id', $appointment_id)->where('appointment_type', 1)->first();
        $this->assertEquals(0, $appointment_after->active);

    }

    /** @test */
    public function authenticated_customer_can_view_details_of_their_queue_appointment()
    {
//        $this->withoutExceptionHandling();
//        $this->seed();

        $this->user = $this->makeCustomer();

        // creating new queue appointment to be able to test it
        $response = $this->actingAs($this->user)->post('/appointments/queue', [
            'store_id' => 2,
            'travel_time' => 10,
            'planned_stay_time' => 20
        ]);

        // getting appointment_id of previously created queue appointment
        $appointment = Appointment::where('user_id', $this->user->id)->where('active', 1)->where('appointment_type', 2)->first();
        $appointment_id = $appointment->appointment_id;

        $response = $this->actingAs($this->user)->get('appointments/' . $appointment_id . '/details')
            ->assertOk();

//        ...or
//        $response = $this->actingAs($this->user)->get(route('appointment.show', [
//            'appointment_id' => $appointment_id
//        ]))->assertOk();

    }

    /** @test */
    public function authenticated_customer_can_delete_their_queue_appointment()
    {
//        $this->withoutExceptionHandling();
//        $this->seed();

        $this->user = $this->makeCustomer();

        $response = $this->actingAs($this->user)->post('/appointments/queue', [
            'store_id' => 2,
            'travel_time' => 10,
            'planned_stay_time' => 20
        ]);

        $appointment_before = Appointment::where('user_id', $this->user->id)->where('active', 1)->where('appointment_type', 2)->first();
        $appointment_id = $appointment_before->appointment_id;

        // checks if deletion redirects to needed view
        $response = $this->actingAs($this->user)->patch('/appointments/queue/' . $appointment_id . '')
            ->assertRedirect('/');

        // checks if queue appointment is updated (deleted) by checking if 'active' was set to 0
        $appointment_after = Appointment::where('user_id', $this->user->id)->where('appointment_id', $appointment_id)->where('appointment_type', 2)->first();
        $this->assertEquals(0, $appointment_after->active);

//        ...or
//        $response = $this->actingAs($this->user)->get(route('appointment.removeQueue', [
//            'appointment_id' => $appointment_id
//        ]))->assertRedirect('/');
//        ...

    }

    /** @test */
    public function authenticated_customer_can_push_back_their_queue_appointment()
    {
//        $this->withoutExceptionHandling();
//        $this->seed();

        $this->user = $this->makeCustomer();

        $response = $this->actingAs($this->user)->post('/appointments/queue', [
            'store_id' => 2,
            'travel_time' => 10,
            'planned_stay_time' => 20
        ]);

        $appointment = Appointment::where('user_id', $this->user->id)->where('active', 1)->where('appointment_type', 2)->first();
        $appointment_id = $appointment->appointment_id;

        // checks if push back redirects to needed view
        $response = $this->actingAs($this->user)->post('/appointments/queue/' . $appointment_id . '/push_back')
            ->assertRedirect('/user/' . $this->user->id . '/placements');

        // checks if old queue appointment is updated (deleted) by checking if 'active' was set to 0
        $appointment_updated = Appointment::where('user_id', $this->user->id)->where('appointment_id', $appointment_id)->where('appointment_type', 2)->first();
        $this->assertEquals(0, $appointment_updated->active);

        // checks if new queue appointment is made with updated parameters
        $new_start_time = date("H:i:s", strtotime($appointment->start_time) + (60 * 60));
        $new_end_time = date("H:i:s", strtotime($appointment->end_time) + (60 * 60));
        $this->assertDatabaseHas('appointments', [
            'user_id' => $appointment->user_id,
            'store_id' => $appointment->store_id,
            'appointment_type' => $appointment->appointment_type,
            'active' => 1,
            'start_time' => $new_start_time,
            'end_time' => $new_end_time
        ]);

    }

    /** @test */
    public function authenticated_customer_can_try_to_find_earlier_timeslot_for_their_queue_appointment()
    {
//        $this->withoutExceptionHandling();
//        $this->seed();

        $this->user = $this->makeCustomer();

        $response = $this->actingAs($this->user)->post('/appointments/queue', [
            'store_id' => 2,
            'travel_time' => 10,
            'planned_stay_time' => 20
        ]);

        $appointment = Appointment::where('user_id', $this->user->id)->where('active', 1)->where('appointment_type', 2)->first();
        $appointment_id = $appointment->appointment_id;

        // checks if that action redirects to needed view
        $response = $this->actingAs($this->user)->get('/appointments/queue/' . $appointment_id . '/available_earlier_timeslot')
            ->assertOK();

    }

    /** @test */
    public function authenticated_customer_can_accept_earlier_timeslot_for_their_queue_appointment()
    {
//        $this->withoutExceptionHandling();
//        $this->seed();

        $this->user = $this->makeCustomer();

        $response = $this->actingAs($this->user)->post('/appointments/queue', [
            'store_id' => 2,
            'travel_time' => 10,
            'planned_stay_time' => 20
        ]);

        $appointment = Appointment::where('user_id', $this->user->id)->where('active', 1)->where('appointment_type', 2)->first();
        $appointment_id = $appointment->appointment_id;

        // getting available earlier timeslot
        $response = $this->actingAs($this->user)->get('/appointments/queue/' . $appointment_id . '/available_earlier_timeslot');
        $best_free_timeslot = $response->getOriginalContent()->getData()['best_free_timeslot'];
        $new_start_time = $best_free_timeslot['start'];
        $new_end_time = $best_free_timeslot['end'];

        // checks if accepting of push forward redirects to needed view
        $response = $this->actingAs($this->user)->patch('/appointments/queue/' . $appointment_id . '/push_forward', [
            'new_start_time' => $new_start_time,
            'new_end_time' => $new_end_time,
        ])
            ->assertRedirect('/user/' . $this->user->id . '/placements');

        // checks if new queue appointment is made with updated parameters
        $this->assertDatabaseHas('appointments', [
            'appointment_id' => $appointment_id,
            'start_time' => $new_start_time,
            'end_time' => $new_end_time
        ]);

    }



    /*************** My placements view ******************/


    /*************** Validation tests ******************/

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
