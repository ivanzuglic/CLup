<?php

namespace App\Http\Controllers\Views;

use App\Store;
use App\StoreOccupancyData;
use App\StoreStatisticalData;
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

            // A flag that enables "Print Ticket" button, initially true
            $is_open = true;

            // Fetching store working hours
            $working_hours = $store->working_hours;
            // Shifting weekday numbers to compensate for Monday = 0, Sunday = 6 setup
            if (date('w') == 0)
            {
                $day_of_week = 6;
            }
            else
            {
                $day_of_week = date('w') - 1;
            }
            // Selecting working hours for today's weekday (if they exist)
            $today_working_hours = $working_hours->where('day', $day_of_week)->first();
            // Setting is_open flag to false if there is no working_hours entry for today's weekday
            if($today_working_hours == null)
            {
                $is_open = false;
            }
            // Checking whether the current time is inside the store's open time window (if working_hours entry for today's weekday exists)
            else
            {
                if(strtotime(date("H:i:s")) < strtotime($today_working_hours->opening_hours)
                   ||
                   strtotime(date("H:i:s")) > strtotime($today_working_hours->closing_hours))
                {
                    $is_open = false;
                }
            }

            // Returning print-tickets-view with managers linked store
            return view('manager_views.print-ticket-view', compact('store', 'is_open'));
        }
        else
        {
            return redirect("/manager/dashboard/print_tickets/{$user->store_id}");
        }
    }

    public function storeStatistics($store_id)
    {
        // Fetching the current user (manager)
        $user = Auth::user();

        if($store_id == $user->store_id)
        {
            // Fetching the manager's linked store
            $store = Store::findorfail($user->store_id);

            $statistical_data = StoreStatisticalData::where('store_id', $store->store_id)->first();
            $occupancy_data = StoreOccupancyData::where('store_id', $store->store_id)->first();
            $occupancy_array = null;

            $stat_exists = false;
            if($statistical_data != null)
            {
                $stat_exists = true;
            }
            $occ_exists = false;
            if($occupancy_data != null)
            {
                $occupancy_array = array_slice ( $occupancy_data->array_customer_density , 6);
                array_push($occupancy_array, 0);

                $occ_exists = true;
            }

            return view('manager_views.managerStatistics',
                array('store' => $store,
                      'stat_exists' => $stat_exists,
                      'statistical_data' => $statistical_data,
                      'occ_exists' => $occ_exists,
                      'occupancy_array' => $occupancy_array));
        }
        else
        {
            return redirect("/manager/dashboard/store_statistics/{$user->store_id}");
        }
    }
}
