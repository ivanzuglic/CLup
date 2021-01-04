<?php

namespace App\Http\Controllers\Views;

use App\Store;
use App\WorkingHours;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
     * Show the Store Parameters view.
     *
     * @param $store_id
     * @return Application|Factory|Response|View
     */
    public function storeParameters($store_id)
    {
        // Fetching the current user (manager)
        $user = Auth::user();

        if($store_id == $user->store_id)
        {
            // Fetching the manager's linked store
            $store = Store::findorfail($user->store_id);

            // Fetching all currently existing working hours entries for the manager's linked store
            $working_hours_existing = app('App\Http\Controllers\Store\WorkingHoursController')->index($store->store_id);;

            // Iterating through days
            for($day = 0; $day < 7; $day++){
                // If entry for a day exists, set working hours form parameters
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

            // Returning managerView with an array containing all the necessary data
            return view('manager_views.managerView', array('store' => $store, 'checkbox' => $checkbox, 'opening_hours' => $opening_hours, 'closing_hours' => $closing_hours));
        }
        else
        {
            return redirect("/manager/dashboard/store_parameters/{$user->store_id}");
        }
    }

    /**
     * Show the Print Tickets view
     *
     * @param $store_id
     * @return Application|Factory|View
     */
    public function printTickets($store_id)
    {
        // Fetching the current user (manager)
        $user = Auth::user();

        if($store_id == $user->store_id)
        {
            // Fetching the manager's linked store
            $store = Store::findorfail($user->store_id);
            // Returning print-tickets-view with managers linked store
            return view('manager_views.print-ticket-view', compact('store'));
        }
        else
        {
            return redirect("/manager/dashboard/print_tickets/{$user->store_id}");
        }
    }
}
