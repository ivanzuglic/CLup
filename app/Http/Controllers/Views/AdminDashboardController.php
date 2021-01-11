<?php

namespace App\Http\Controllers\Views;

use App\Store;
use App\StoreType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\View\View;

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
     * Show the Add Store view.
     *
     * @return Application|Factory|Response|View
     */
    public function addStore()
    {
        // Fetching all available store types
        $store_types = StoreType::all();
        // Returning addStore view with all store types
        return view('admin_views.addStore', compact('store_types'));
    }

    /**
     * Show the Add Manager view
     *
     * @return Application|Factory|View
     */
    public function addManager()
    {
        // Fetching all currently existing stores
        $stores = Store::all();
        // Returning addManager view with all currently existing stores
        return view('admin_views.addManager', compact('stores'));
    }
}
