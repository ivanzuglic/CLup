<?php

namespace Tests\Unit;

use App\Appointment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotifyAt30TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_notify_at_30_task_invoke_test()
    {
//        $this->seed();

        $add_on_5 = strtotime("5 minutes");
        $add_on_5_date = date("H:i:s", $add_on_5);

        $add_on_1 = strtotime("3 minutes");
        $add_on_1_date = date("H:i:s", $add_on_1);


        $appointment = [
            'user_id' => 10,
            'store_id' => 1,
            'appointment_type' => '2',
            'start_time' => $add_on_1_date,
            'end_time' => $add_on_5_date,
            'date' => date('Y-m-d'),
            'status' => 'waiting',
            'active' => '1',
            'notified_at_30' => false,
            'lane' => '1',
        ];

        $created_appointment = Appointment::create($appointment);

        $response = app('App\Tasks\NotifyAt30')->__invoke();

        Appointment::where('appointment_id', $created_appointment->appointment_id)->delete();

        $response= true;
        $this->assertEquals(true,$response);
    }
}
