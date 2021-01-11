<?php

namespace Tests\Unit;


use Illuminate\Http\Request;
use Tests\Feature\BasicFeatureCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class storeWorkingHoursTest extends BasicFeatureCase
{
    use refreshDatabase;

    /** @test */
    public function test_workingHours_store_with_valid_store_id()
    {
        $this->withoutExceptionHandling();

        $request = new Request([
            'store_id' => '1',
            'day' => '5',
            'opening_hours' => '08:00:00',
            'closing_hours' => '21:00:00',
        ]);

        $response = app('App\Http\Controllers\Store\WorkingHoursController')->store($request, 1);

        $this->assertEquals($request->store_id, $response->store_id);
    }

    /** @test */
    public function test_workingHours_store_with_invalid_store_id()
    {
        $this->withoutExceptionHandling();

        $request = new Request([
            'store_id' => '1',
            'day' => '5',
            'opening_hours' => '08:00:00',
            'closing_hours' => '21:00:00',
        ]);

        $response = app('App\Http\Controllers\Store\WorkingHoursController')->store($request, 2);

        $this->assertH;
    }

}

