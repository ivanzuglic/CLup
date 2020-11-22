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
        return Store::all();
    }

    public function create()
    {

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
