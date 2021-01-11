<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

class StoreTest extends TestCase
{
    use refreshDatabase;

    /** @test */
    public function testExample()
    {
//        $this->seed();
        $this->withoutExceptionHandling();

        $request = new Request([
            'store_id' => '1',
            'user_id' => '12',
            'appointment_type' => '2',
            'start_time' => '14:00:00',
            'end_time' => '14:20:00',
            'date' => '2021-01-09',
            'status' => 'waiting',
            'active' => TRUE,
            'lane' => '1'
        ]);

        $response = app('App\Http\Controllers\Appointment\AppointmentController')->store($request);
        $this->assertEquals(12,$response->user_id);
    }
}
