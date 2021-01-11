<?php

namespace Tests\Unit;

use App\StoreOccupancyData;
use App\StoreStatisticalData;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreOccupancyDataControllerTest extends TestCase
{
    use refreshDatabase;


    /** @test */
    public function test_index_store_occupancy_data_controller()
    {
//        $this->seed();

        $statistical_data = [
            'store_id' => '1',
            'array_customer_density' =>
            [0, 0, 0, 0, 0, 0,
             0, 0, 0, 0, 0, 0,
             0, 0, 0, 0, 0, 0,
             0, 0, 0, 0, 0, 0]
        ];

        $created_data = StoreOccupancyData::create($statistical_data);

        $statistical_data2 = [
            'store_id' => '2',
            'array_customer_density' =>
                    [1, 0, 0, 0, 0, 0,
                    0, 0, 0, 0, 0, 0,
                    0, 0, 0, 0, 0, 0,
                    0, 0, 0, 0, 0, 0]
        ];

        $created_data = StoreOccupancyData::create($statistical_data2);
        $response = app('App\Http\Controllers\Statistics\StoreOccupancyDataController')->index();
        $this->assertCount(20,$response);
    }

    public function test_show_store_statistical_data_controller()
    {
//        $this->seed();
        $statistical_data = [
            'store_id' => '3',
            'array_customer_density' =>
                [0, 0, 0, 0, 0, 0,
                    0, 0, 0, 0, 0, 0,
                    0, 0, 0, 0, 0, 0,
                    0, 0, 0, 0, 0, 0]
        ];

        $created_data = StoreOccupancyData::create($statistical_data);

        $response = app('App\Http\Controllers\Statistics\StoreOccupancyDataController')->show($created_data->store_id);
        $this->assertEquals(22, $created_data->store_occupancy_data_id);
    }
}
