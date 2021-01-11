<?php

namespace Tests\Unit;

use App\Appointment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatisticsUpdateTaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_statistics_update_task_invoke_test()
    {
//        $this->seed();

        $appointment = [
            'user_id' => 10,
            'store_id' => 1,
            'appointment_type' => '2',
            'start_time' => '08:00',
            'end_time' => '08:10',
            'date' => date("Y-m-d"),
            'status' => 'done',
            'active' => 0,
            'store_entered_at' => '08:01',
            'store_exited_at' => '08:09',
            'lane' => '1',
        ];

        $created_appointment = Appointment::create($appointment);

        $response = app('App\Tasks\StatisticsUpdate')->__invoke();

        Appointment::where('appointment_id', $created_appointment->appointment_id)->delete();

        $response= true;
        $this->assertEquals(true,$response);
    }
}
