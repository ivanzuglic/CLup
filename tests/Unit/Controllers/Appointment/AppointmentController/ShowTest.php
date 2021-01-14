<?php

namespace Tests\Unit;

use App\Appointment;
use Illuminate\Support\Facades\Auth;
use Tests\Feature\BasicFeatureCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestResponse;

class ShowTest extends BasicFeatureCase
{
    use refreshDatabase;

    /** @test */
    public function test_day_of_the_week_line()
    {
        $this->seed();
        $this->withoutExceptionHandling();
        $this->user = $this->actingAsCustomer();

        $appointment = [
            'user_id' => '15',
            'store_id' => '1',
            'appointment_type' => '2',
            'start_time' => '14:00',
            'end_time' => '14:30',
            'date' => '2021-01-10',
            'status' => 'waiting',
            'active' => '1',
            'lane' => '1',
        ];


        $created_appointment = Appointment::create($appointment);
        $response = app('App\Http\Controllers\Appointment\AppointmentController')->show($created_appointment->appointment_id);
        $this->assertAuthenticated();
    }
}
