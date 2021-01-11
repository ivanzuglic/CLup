<?php

namespace Tests\Unit;

use App\Appointment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class indexTest extends TestCase
{
    use refreshDatabase;

    /** @test */
    public function test_index_appointment_controller()
    {
//        $this->seed();
        $this->withoutExceptionHandling();
        $appointment = [
            'user_id' => '14',
            'store_id' => '1',
            'appointment_type' => '2',
            'start_time' => '14:00',
            'end_time' => '14:30',
            'date' => date('Y-m-d'),
            'status' => 'waiting',
            'active' => '1',
            'lane' => '1',
        ];

        $created_appointment = Appointment::create($appointment);
        $response = app('App\Http\Controllers\Appointment\AppointmentController')->index();
        $this->assertCount(24,$response);
    }
}
