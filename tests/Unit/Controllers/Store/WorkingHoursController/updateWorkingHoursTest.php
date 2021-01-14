<?php

namespace Tests\Unit;


use App\WorkingHours;
use Illuminate\Http\Request;
use Tests\Feature\BasicFeatureCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class updateWorkingHoursTest extends BasicFeatureCase
{
    use refreshDatabase;

    /** @test */
    public function test_workingHours_update_with_valid_store_id()
    {
//        $this->seed();
//        $this->withoutExceptionHandling();

        $store_id = 1;

        $working_hours_data = [
            'store_id' =>  $store_id,
            'day' => '5',
            'opening_hours' => '08:00:00',
            'closing_hours' => '21:00:00',
        ];


        $working_hours = WorkingHours::create($working_hours_data);

        $request = new Request([
            'working_hours_id' => $working_hours->id,
            'store_id' => $store_id,
            'day' => '5',
            'opening_hours' => '09:00:00',
            'closing_hours' => '21:00:00',
        ]);

        $response = app('App\Http\Controllers\Store\WorkingHoursController')->update($request, $store_id, $working_hours->working_hours_id);
        $this->assertEquals($working_hours->working_hours_id, $response->working_hours_id);
    }

    /** @test */
    public function test_workingHours_update_with_invalid_store_id()
    {
//        $this->seed();
//        $this->withoutExceptionHandling();

        $store_id = 1;

        $working_hours_data = [
            'store_id' =>  $store_id,
            'day' => '5',
            'opening_hours' => '08:00:00',
            'closing_hours' => '21:00:00',
        ];


        $working_hours = WorkingHours::create($working_hours_data);

        $request = new Request([
            'working_hours_id' => $working_hours->id,
            'store_id' => $store_id,
            'day' => '5',
            'opening_hours' => '09:00:00',
            'closing_hours' => '21:00:00',
        ]);

        $response = app('App\Http\Controllers\Store\WorkingHoursController')->update($request, 2, $working_hours->working_hours_id);
        $error_msg = $response->getOriginalContent();
        $this->assertEquals("store_id and working_hours_id do not match!", $error_msg['error']);

    }

}

