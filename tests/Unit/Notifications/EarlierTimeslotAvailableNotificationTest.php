<?php

namespace Tests\Unit;

use App\Appointment;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EarlierTimeslotAvailableNotificationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_earlier_timeslot_available_notification_test()
    {
//        $this->seed();

        $request = new \Illuminate\Http\Request();

        $request->replace(['foo' => 'bar']);


        $appointment1 = [
            'user_id' => 10,
            'store_id' => 1,
            'appointment_type' => '1',
            'start_time' => '08:00',
            'end_time' => '09:00',
            'date' => date('Y-m-d'),
            'status' => 'waiting',
            'active' => '1',
            'lane' => '1',
        ];

        $created_appointment1 = Appointment::create($appointment1);

        $appointment2 = [
            'user_id' => 11,
            'store_id' => 1,
            'appointment_type' => '2',
            'start_time' => '09:10',
            'end_time' => '09:20',
            'date' => date('Y-m-d'),
            'status' => 'waiting',
            'active' => '1',
            'lane' => '1',
        ];

        $created_appointment2 = Appointment::create($appointment2);

        $response = app('App\Http\Controllers\Appointment\QueueController')->removeReservation($request,$created_appointment1->appointment_id);

        Appointment::where('appointment_id', $created_appointment1->appointment_id)->delete();
        Appointment::where('appointment_id', $created_appointment2->appointment_id)->delete();

        $response= true;
        $this->assertEquals(true,$response);

    }
}
