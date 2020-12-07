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

    /** @test */
    public function only_logged_in_customer_can_see_home_page()
    {
        $this->seed();
        $response = $this->get('/home')
            ->assertRedirect('/login');

    }

    /** @test */
    public function authenticated_customer_can_edit_their_profile()
    {
        $this->seed();
        $this->actingAs(factory(User::class)->create());

        $response = $this->get('/user_profile/edit')
            ->assertOk();

    }

    /** @test */
    public function authenticated_customer_can_update_their_profile()
    {
        $this->seed();
        //$this->withoutExceptionHandling();
        $user = factory(User::class)->create([
            'name' => 'Test User'
        ]);

        $this->actingAs($user);

        $response = $this->patch('/user_profile/update', [
           'name' => 'Test User',
           'email' => 'test@test.com',
           'phone_number' => '87654321'
        ])->assertRedirect('/');

      //  $this->assertCount(3, User::all());

    }

    /** @test */
    public function authenticated_customer_can_update_their_password()
    {
        $this->seed();
        //$this->withoutExceptionHandling();    // use when you want more details of error (only when test fails)
        $user = factory(User::class)->create([
            'name' => 'Test User',
            'email' => 'test@test.com'
        ]);

        $this->actingAs($user);

        $response = $this->patch('/user_profile/update/pass', [
            'password' => 'test321',
            'password_confirmation' => 'test321'
        ])->assertRedirect('/');

        //  $this->assertCount(3, User::all());

    }

}
