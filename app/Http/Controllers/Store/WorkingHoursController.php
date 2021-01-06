<?php

namespace App\Http\Controllers\Store;

use App\WorkingHours;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WorkingHoursController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->middleware('auth');
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

    // Bulk Create/Update/Delete function
    public function bulk_CUD(Request $request, $store_id)
    {
        // Iteration for each day
        for($day = 0; $day < 7; $day++)
        {
            // If there is an array with selected days present in the request and there is a current iterator day in it
            if($request->has('days_selected') && in_array($day, $request->days_selected))
            {
                // If both opening hours and closing hours are defined
                if($request->opening_hours[$day] != null && $request->closing_hours[$day] != null)
                {
                    // If entry for the iterating day already exists in the database
                    if(WorkingHours::where([['day', '=', $day], ['store_id', '=', $store_id]])->exists())
                    {
                        $working_hours_update = WorkingHours::where([['day', '=', $day], ['store_id', '=', $store_id]])->firstOrFail();
                        $working_hours_update->update([
                            'opening_hours' => $request->opening_hours[$day],
                            'closing_hours' => $request->closing_hours[$day],
                        ]);
                    }
                    // Else, create a new entry
                    else
                    {
                        WorkingHours::create([
                            'store_id' => $store_id,
                            'day' => $day,
                            'opening_hours' => $request->opening_hours[$day],
                            'closing_hours' => $request->closing_hours[$day],
                        ]);
                    }
                }
            }
            else
            {
                // If entry for the iterating day exists in the database, but isn't selected
                if(WorkingHours::where([['day', '=', $day], ['store_id', '=', $store_id]])->exists())
                {
                    $working_hours_delete = WorkingHours::where([['day', '=', $day], ['store_id', '=', $store_id]])->firstOrFail();
                    $working_hours_delete->delete();
                }
            }
        }

//        if($request->has('days_selected'))
//        {
//            foreach ($request->days_selected as $day)
//            {
//               if($request->opening_hours[$day] != null && $request->closing_hours[$day] != null)
//                {
//                    DB::table('working_hours')
//                        ->updateOrInsert(
//                            ['store_id' => $store_id, 'day' => $day],
//                            ['opening_hours' => $request->opening_hours[$day], 'closing_hours' => $request->closing_hours[$day]]
//                        );
//                }
//            }
//        }

        return back();
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
