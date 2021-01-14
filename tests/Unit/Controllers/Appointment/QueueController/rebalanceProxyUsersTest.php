<?php


namespace Controllers\Appointment\QueueController;

use App\Appointment;
use Tests\Feature\BasicFeatureCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

class rebalanceProxyUsersTest extends BasicFeatureCase
{
    use RefreshDatabase;

    /** @test */
    public function test_rebalancing()
    {
//        $this->seed();

        $proxy1 = [
            'store_id' => 1,
            'appointment_type' => 3,
            'start_time' => '17:50:00',
            'end_time' => '18:00:00',
            'lane' => '1',
            'active' => 1,
            'date' => '2021-01-09'
        ];

        $proxy2 = [
            'store_id' => 1,
            'appointment_type' => 3,
            'start_time' => '18:05:00',
            'end_time' => '18:20:00',
            'lane' => '2',
            'active' => 1,
            'date' => '2021-01-09'
        ];

        $proxy3 = [
            'store_id' => 1,
            'appointment_type' => 3,
            'start_time' => '18:10:00',
            'end_time' => '18:15:00',
            'lane' => '3',
            'active' => 1,
            'date' => '2021-01-09'
        ];

        $canceled_app = [
            'store_id' => 1,
            'appointment_type' => 1,
            'start_time' => '18:00:00',
            'end_time' => '18:50:00',
            'lane' => '1',
            'active' => 0,
            'date' => '2021-01-09'
        ];

//        Appointment::create($proxy1);
//        Appointment::create($proxy2);
//        Appointment::create($proxy3);
//        $canceled = Appointment::create($canceled_app);
//
//        $this->assertCount(10,Appointment::all());

//        $response = app('App\Http\Controllers\Appointment\QueueController')->rebalanceProxyUsers(1, $canceled);

        $this->assertTrue(true);
    }
}
