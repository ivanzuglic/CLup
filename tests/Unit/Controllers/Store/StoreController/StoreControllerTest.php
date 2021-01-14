<?php

namespace Tests\Unit;


use App\Store;
use App\WorkingHours;
use Illuminate\Http\Request;
use Tests\Feature\BasicFeatureCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class storeControllerTest extends BasicFeatureCase
{
    use refreshDatabase;

    /** @test */
    public function test_storeController_show()
    {
//        $this->seed();
//        $this->withoutExceptionHandling();

        $store_id = 1;

        $response = app('App\Http\Controllers\Store\StoreController')->show($store_id);
        $this->assertEquals($store_id, $response->store_id);
    }

    /** @test */
    public function test_storeController_destroy()
    {
//        $this->seed();
//        $this->withoutExceptionHandling();

        $store_data = [
            'name' => 'Store to delete',
            'description' => 'I do not want to put image',
            'store_type' => '1',
            'image_reference' => '',
            'address_line_1' => 'Delete 1',
            'zip_code' => "20000",
            'town' => "London",
            'country' => 'Alpha',
            'max_occupancy' => '100',
            'current_occupancy' => '0',
        ];

        $store = Store::create($store_data);

        $request = new Request([
            'store_id' => $store->store_id
        ]);

        $response = app('App\Http\Controllers\Store\StoreController')->destroy($request, $store->store_id);
        $this->assertEquals(204, $response);
    }

}

