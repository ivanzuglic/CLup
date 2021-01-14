<?php

namespace Tests\Unit;

use App\StoreStatisticalData;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreStatisticalDataControllerTest extends TestCase
{
    use refreshDatabase;

    /** @test */
    public function test_index_store_statistical_data_controller()
    {
//        $this->seed();

        $statistical_data = [
            'store_id' => '3',
            'avg_customers' => '2',
            'avg_time_spent_min' => '5',
            'n_customers' => '3',
            'n_days' => '5',
        ];

        $created_data = StoreStatisticalData::create($statistical_data);

        $statistical_data2 = [
            'store_id' => '2',
            'avg_customers' => '4',
            'avg_time_spent_min' => '10',
            'n_customers' => '6',
            'n_days' => '10',
        ];

        $created_data = StoreStatisticalData::create($statistical_data2);
        $response = app('App\Http\Controllers\Statistics\StoreStatisticalDataController')->index();
        $this->assertCount(20,$response);
    }

    public function test_show_store_statistical_data_controller()
    {
//        $this->seed();

        $statistical_data = [
            'store_id' => '1',
            'avg_customers' => '2',
            'avg_time_spent_min' => '5',
            'n_customers' => '3',
            'n_days' => '5',
        ];

        $created_data = StoreStatisticalData::create($statistical_data);
        $response = app('App\Http\Controllers\Statistics\StoreStatisticalDataController')->show($created_data->store_id);
        $this->assertEquals(22, $created_data->store_statistical_data_id);
    }
}
