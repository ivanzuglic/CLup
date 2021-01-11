<?php

namespace Tests\Unit;

use App\Appointment;
use App\Roles;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppointmentPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_appointment_policy_view_test()
    {
//        $this->seed();

        $appointment = Appointment::where('appointment_id', 1)->first();
        $user = User::where('id', 10)->first();

        $response = app('App\Policies\AppointmentPolicy')->view($user, $appointment);
        $this->assertEquals(true,$response);
    }

    /** @test */
    public function test_appointment_policy_create_test()
    {
//        $this->seed();

        $user = User::where('id', 10)->first();

        $response = app('App\Policies\AppointmentPolicy')->create($user);

        $this->assertEquals(true,$response);
    }

    /** @test */
    public function test_appointment_policy_update_test()
    {
//        $this->seed();

        $appointment = Appointment::where('appointment_id', 1)->first();
        $user = User::where('id', 10)->first();

        $response = app('App\Policies\AppointmentPolicy')->update($user, $appointment);

        $this->assertEquals(false,$response);
    }

    /** @test */
    public function test_appointment_policy_delete_test()
    {
//        $this->seed();

        $appointment = Appointment::where('appointment_id', 1)->first();
        $user = User::where('id', 10)->first();

        $response = app('App\Policies\AppointmentPolicy')->delete($user, $appointment);

        $this->assertEquals(false,$response);
    }

    /** @test */
    public function test_appointment_policy_restore_test()
    {
//        $this->seed();

        $appointment = Appointment::where('appointment_id', 1)->first();
        $user = User::where('id', 10)->first();

        $response = app('App\Policies\AppointmentPolicy')->restore($user, $appointment);

        $this->assertEquals(false,$response);
    }

    /** @test */
    public function test_appointment_policy_force_delete_test()
    {
//        $this->seed();

        $appointment = Appointment::where('appointment_id', 1)->first();
        $user = User::where('id', 10)->first();

        $response = app('App\Policies\AppointmentPolicy')->restore($user, $appointment);

        $this->assertEquals(false,$response);
    }
}
