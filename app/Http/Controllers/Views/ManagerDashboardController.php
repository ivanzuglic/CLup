<?php

namespace App\Http\Controllers\Views;

use App\Store;
use App\WorkingHours;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ManagerDashboardController extends Controller
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
        $user = Auth::user();
        $store = Store::findorfail($user->store_id);

        $working_hours_existing = app('App\Http\Controllers\Store\WorkingHoursController')->index($store->store_id);;
        for($day = 0; $day < 7; $day++){
            if($working_hours_existing->contains('day', $day))
            {
                $checkbox[$day] = 'checked';
                $opening_hours[$day] = ($working_hours_existing->firstWhere('day', $day))->opening_hours;
                $closing_hours[$day] = ($working_hours_existing->firstWhere('day', $day))->closing_hours;
            }
            else
            {
                $checkbox[$day] = '';
                $opening_hours[$day] = null;
                $closing_hours[$day] = null;
            }
        }

        return view('manager_views.managerView', array('store' => $store, 'checkbox' => $checkbox, 'opening_hours' => $opening_hours, 'closing_hours' => $closing_hours));
    }

    public function printTickets()
    {
        $user = Auth::user();
        $store = Store::findorfail($user->store_id);

        return view('manager_views.print-ticket-view', compact('store'));
    }
}
