<?php

namespace App\Http\Controllers\Store;

use App\WorkingHours;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WorkingHoursController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = Auth::user();

    }

    public function index($store_id)
    {
        return WorkingHours::where('store_id', $store_id)
               ->orderBy('day', 'asc')->get();
    }

    public function create ()
    {

    }

    public function store(Request $request, $store_id)
    {
        if($store_id == $request->store_id){
            return WorkingHours::create($request->all());
        }

        return response()->json(['error' => 'store_id and working_hours_id do not match!'], 500);
    }

    public function show($store_id, $working_hours_id)
    {
        $working_hours = WorkingHours::findOrFail($working_hours_id);

        if($working_hours->store_id == $store_id){
            return $working_hours;
        }

        return response()->json(['error' => 'store_id and working_hours_id do not match!'], 404);
    }

    public function edit ()
    {

    }

    public function update (Request $request, $store_id, $working_hours_id)
    {
        $working_hours = WorkingHours::findOrFail($working_hours_id);

        if($working_hours->store_id == $store_id){
            $working_hours->update($request->all());

            return $working_hours;
        }

        return response()->json(['error' => 'store_id and working_hours_id do not match!'], 500);
    }

    public function destroy (Request $request, $store_id, $working_hours_id)
    {
        $working_hours = WorkingHours::findOrFail($working_hours_id);

        if($working_hours->store_id == $store_id){
            $working_hours->delete();

            return response()->json(null, 204);
        }

        return response()->json(['error' => 'store_id and working_hours_id do not match!'], 500);
    }
}
