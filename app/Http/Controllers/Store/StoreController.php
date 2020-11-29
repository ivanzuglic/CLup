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

        return $store->with('type')->get();

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
            'address_line_2' => 'string|max:255',
            'zip_code' => 'required|string|regex:/\b\d{5}\b/',
            'town' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'image_reference' => '',
            'max_occupancy' => 'required|integer|min:1',
            'current_occupancy' => 'required|integer|min:0|max:0',
            'max_reservation_ratio' => 'required|numeric|min:0.0|max:1.0',
        ]);

        return Store::create($request->all());
    }

    public function show($store_id)
    {
        return Store::findOrFail($store_id);
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

        return $store;
    }

    public function destroy(Request $request, $store_id)
    {
        $store = Store::findOrFail($store_id);
        $store->delete();

        return 204;
    }
}
