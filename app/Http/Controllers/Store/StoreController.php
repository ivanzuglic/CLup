<?php

namespace App\Http\Controllers\Store;

use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->middleware('auth');
        $this->user = Auth::user();
    }

    public function index()
    {

//        return Store::with('store_type')->get();

        $search_string = isset($_GET['search_string']) ? $_GET['search_string'] : "";
        $store = (new Store)->newQuery();

        //searching where name, description, country, town or zipcode contain searched string
        $store->where(function ($query) use ($search_string) {
            $query->where('name', 'LIKE', '%' . $search_string . '%')
                ->orWhere('description', 'LIKE', '%' . $search_string . '%')
                ->orWhere('town', 'LIKE', '%' . $search_string . '%')
                ->orWhere('country', 'LIKE', '%' . $search_string . '%')
                ->orWhere('zip_code', 'LIKE', '%' . $search_string . '%');
        })->get();

        $stores = $store->with('type')->with(['working_hours' => function ($query) {
            if(date('w') == 0)
            {
                $day_of_week = 6;
            }
            else
            {
                $day_of_week = date('w') - 1;
            }

            $query->where('day', '=', $day_of_week);
        }])->get();

        return view('customer_views.find-store',compact('stores'));

    }

    public function create()
    {
        // return creation field
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'max:1000',
            'store_type' => 'required|integer|exists:store_types,type_id',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'string|nullable|max:255',
            'zip_code' => 'required|string|regex:/\b\d{5}\b/',
            'town' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'image_reference' => '',
            'max_occupancy' => 'required|integer|min:1',
            'current_occupancy' => 'required|integer|in:0',
            'max_reservation_ratio' => 'numeric|min:0.0|max:1.0',
        ]);

         Store::create($request->all());
         return back();
    }

    public function show($store_id)
    {
        return Store::findOrFail($store_id);
    }

    public function show_details($store_id)
    {
        $store = Store::where('store_id', $store_id)->with('type')->with(['working_hours' => function ($query) {
            if(date('w') == 0)
            {
                $day_of_week = 6;
            }
            else
            {
                $day_of_week = date('w') - 1;
            }

            $query->where('day', '=', $day_of_week);
        }])->first();

        return view('customer_views.store-details', array('store' => $store));
    }

    public function edit()
    {
        // return edit field
    }

    public function update(Request $request, $store_id)
    {
        $request->validate([
            'name' => 'string|max:255',
            'description' => 'max:1000',
            'store_type' => 'integer|exists:store_types,type_id',
            'address_line_1' => 'string|max:255',
            'address_line_2' => 'string|max:255',
            'zip_code' => 'string|regex:/\b\d{5}\b/',
            'town' => 'string|max:255',
            'country' => 'string|max:255',
            'image_reference' => '',
            'max_occupancy' => 'integer|min:1',
            'current_occupancy' => 'integer|min:0',
            'max_reservation_ratio' => 'numeric|min:0.0|max:1.0',
        ]);

        $store = Store::findOrFail($store_id);
        $store->update($request->all());

        if($request->hasFile('image_reference')) {
           $filename = $request->image_reference->getClientOriginalName();
           $request->image_reference->storeAs('images',  $filename, 'public');
           $store->update(['image_reference'=>$filename]);
        }

        return back();
    }

    public function destroy(Request $request, $store_id)
    {
        $store = Store::findOrFail($store_id);
        $store->delete();

        return 204;
    }
}
