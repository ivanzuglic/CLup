<?php

namespace Tests\Unit;


use App\WorkingHours;
use Illuminate\Http\Request;
use Tests\Feature\BasicFeatureCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class showWorkingHoursTest extends BasicFeatureCase
{
    use refreshDatabase;

    /** @test */
    public function test_workingHours_show_with_valid_store_id()
    {
//        $this->seed();
        $this->withoutExceptionHandling();

        $working_hours_data = [
            'store_id' => '1',
            'day' => '5',
            'opening_hours' => '08:00:00',
            'closing_hours' => '21:00:00',
        ];

        $store_id = 1;
        $working_hours = WorkingHours::create($working_hours_data);

        $response = app('App\Http\Controllers\Store\WorkingHoursController')->show($store_id, $working_hours->working_hours_id);
        $this->assertEquals($working_hours->working_hours_id, $response->working_hours_id);
    }

    /** @test */
    public function test_workingHours_show_with_invalid_store_id()
    {
//        $this->seed();
        $this->withoutExceptionHandling();

        $working_hours_data = [
            'store_id' => '1',
            'day' => '5',
            'opening_hours' => '08:00:00',
            'closing_hours' => '21:00:00',
        ];

        $store_id = 1;
        $working_hours = WorkingHours::create($working_hours_data);

        $response = app('App\Http\Controllers\Store\WorkingHoursController')->show($store_id, 8);
        $error_msg = $response->getOriginalContent();
        $this->assertEquals("store_id and working_hours_id do not match!", $error_msg['error']);

    }

}

