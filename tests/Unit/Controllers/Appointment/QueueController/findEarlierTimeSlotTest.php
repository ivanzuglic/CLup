<?php

namespace Controllers\Appointment\QueueController;

use App\Appointment;
use Carbon\Carbon;
use Tests\Feature\BasicFeatureCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class findEarlierTimeSlotTest extends BasicFeatureCase
{
    use RefreshDatabase;

    /** @test */
    public function test_improvement_is_true()
    {
//        $this->seed();
        Carbon::setTestNow('2021-01-24');

        $appointment = [
            'user_id' => '2',
            'store_id' => '2',
            'appointment_type' => '2',
            'start_time' => '21:00',
            'end_time' => '21:20',
            'status' => 'waiting',
            'lane' => '1',
            'active' => '1',
            'date' => Carbon::now(),
        ];

        $created_data = Appointment::create($appointment);

        $response = app('App\Http\Controllers\Appointment\QueueController')->findEarlierTimeSlot($created_data->appointment_id);
        $this->assertEquals(true,$response->improvement);
    }
}
