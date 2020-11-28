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

        return $store->with('store_type')->get();
    }

    public function create()
    {
        // return creation field
    }

    public function store(Request $request)
    {
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
