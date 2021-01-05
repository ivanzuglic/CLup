<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
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

        $this->seed();

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
    public function only_logged_in_customer_can_see_edit_form()
    {
        $response = $this->get('/profile/edit')
            ->assertRedirect('/login');

    }

    /** @test */
    public function authenticated_customer_can_see_edit_form()
    {
        $this->actingAsCustomer();

        $response = $this->get('/profile/edit')
            ->assertOk();

    }

    /** @test */
    public function only_logged_in_customer_can_update_their_profile_through_form()
    {
        $response = $this->patch('/profile/update', $this->data())
            ->assertRedirect('/login');

    }

    /** @test */
    public function authenticated_customer_can_update_their_profile_through_form()
    {
        //$this->withoutExceptionHandling();

        $this->actingAsCustomer();

        $response = $this->patch('/profile/update', $this->data())
            ->assertRedirect('/');

      //  $this->assertCount(3, User::all());

    }

    /** @test */
    public function authenticated_customer_can_update_their_password_through_form()
    {
        //$this->withoutExceptionHandling();    // use when you want more details of error (only when test fails)

        $this->actingAsCustomer();

        $response = $this->patch('/profile/update/password', [
            'password' => 'test321',
            'password_confirmation' => 'test321'
        ])->assertRedirect('/');

        //  $this->assertCount(3, User::all());

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

        $response = $this->patch('/profile/update', array_merge($this->data(), ['name' => '']));
        $response->assertSessionHasErrors('name');
    }


    /** @test */
    public function an_email_is_required()
    {
        //$this->withoutExceptionHandling();

        $this->actingAsCustomer();

        $response = $this->patch('/profile/update', array_merge($this->data(), ['email' => '']));
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function a_valid_email_is_required()
    {
        //$this->withoutExceptionHandling();

        $this->actingAsCustomer();

        $response = $this->patch('/profile/update', array_merge($this->data(), ['email' => 'test_test']));
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function a_phone_number_is_required()
    {
        //$this->withoutExceptionHandling();

        $this->actingAsCustomer();

        $response = $this->patch('/profile/update', array_merge($this->data(), ['phone_number' => '']));
        $response->assertSessionHasErrors('phone_number');
    }

    /** @test */
    public function a_phone_number_must_be_at_least_8_characters()
    {
        //$this->withoutExceptionHandling();

        $this->actingAsCustomer();

        $response = $this->patch('/profile/update', array_merge($this->data(), ['phone_number' => '123']));
        $response->assertSessionHasErrors('phone_number');
    }

    /** @test */
    public function a_phone_number_must_be_max_16_characters()
    {
        //$this->withoutExceptionHandling();

        $this->actingAsCustomer();

        $response = $this->patch('/profile/update', array_merge($this->data(), ['phone_number' => '12345678901234567']));
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


    /*
     * Private functions
     */
    private function actingAsCustomer()
    {
        $this->actingAs(factory(User::class)->create([
            'role_id' => '2',
        ]));
    }

    /*
     * Function that returns data that we want to edit
     */
    private function data()
    {
        return [
            'name' => 'Test Customer',
            'email' => 'test@test.com',
            'phone_number' => '87654321'
        ];
    }

}
