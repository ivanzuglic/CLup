<?php

namespace App\Http\Controllers\Views;

use App\Store;
use App\StoreType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function addStore()
    {
        $store_types = StoreType::all();
        return view('admin_views.addStore', compact('store_types'));
    }

    public function addManager()
    {
        $stores = Store::all();
        return view('admin_views.addManager', compact('stores'));
    }
}
