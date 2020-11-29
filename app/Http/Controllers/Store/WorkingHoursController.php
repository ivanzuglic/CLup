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
        // return creation field
    }

    public function store(Request $request, $store_id)
    {
        if($store_id == $request->store_id){

            $request->validate([
                'store_id' => 'required|integer|exists:stores,store_id',
                'day' => 'required|integer|between:0,6',
                'opening_hours' => 'required|date_format:H:i:s',
                'closing_hours' => 'required|date_format:H:i:s',
            ]);

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
        // return edit field
    }

    public function update (Request $request, $store_id, $working_hours_id)
    {
        $working_hours = WorkingHours::findOrFail($working_hours_id);


        if($working_hours->store_id == $store_id){

            $request->validate([
                'store_id' => 'integer|exists:stores,store_id',
                'day' => 'integer|between:0,6',
                'opening_hours' => 'date_format:H:i:s',
                'closing_hours' => 'date_format:H:i:s',
            ]);

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
