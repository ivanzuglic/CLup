<?php

namespace App\Http\Controllers\Statistics;

use App\StoreStatisticalData;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;

class StoreStatisticalDataController extends Controller
{
    /**
     * @return StoreStatisticalData[]|Collection
     */
    public function index()
    {
        return StoreStatisticalData::all();
    }

    /**
     * @param $store_id
     * @return mixed
     */
    public function show($store_id)
    {
        return StoreStatisticalData::where('store_id', $store_id)->first();
    }

    /**
     * @param $store_id
     */
    public function initialize($store_id)
    {
        StoreStatisticalData::create([
            'store_id' => $store_id,
            'avg_customers' => 0,
            'avg_time_spent_min' => 0,
            'n_customers' => 0,
            'n_days' => 0,
        ]);
    }
}
