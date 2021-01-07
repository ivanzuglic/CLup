<?php

namespace App\Http\Controllers\Statistics;

use App\StoreOccupancyData;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;

class StoreOccupancyDataController extends Controller
{
    /**
     * @return StoreOccupancyData[]|Collection
     */
    public function index()
    {
        return StoreOccupancyData::all();
    }

    /**
     * @param $store_id
     * @return mixed
     */
    public function show($store_id)
    {
        return StoreOccupancyData::where('store_id', $store_id)->first();
    }

    /**
     * @param $store_id
     */
    public function initialize($store_id)
    {
        StoreOccupancyData::create([
            'store_id' => $store_id,
            'array_customer_density' =>
            [0, 0, 0, 0, 0, 0,
             0, 0, 0, 0, 0, 0,
             0, 0, 0, 0, 0, 0,
             0, 0, 0, 0, 0, 0]
        ]);
    }
}
