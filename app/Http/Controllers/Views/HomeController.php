<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;

class HomeController extends Controller
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
    public function __invoke()
    {
        return $stores = app('App\Http\Controllers\Store\StoreController')->index();
    }
}
