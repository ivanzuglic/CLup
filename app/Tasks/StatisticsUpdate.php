<?php

namespace App\Tasks;

use App\Appointment;
use App\Store;
use App\StoreOccupancyData;
use App\StoreStatisticalData;

class StatisticsUpdate
{
    // Invokable function (the only function) called on creation of a new task instance
    public function __invoke()
    {
        // Fetching all the stores (task needs to be performed for all stores)
        $stores = Store::all();

        foreach($stores as $store)
        {
            // Fetching all the appointments for the passed day
            $appointments = $store->getAllCompletedAppointmentsForToday();

            // ==== OCCUPANCY DATA UPDATE ====
            // Fetching the occupancy data (if the row in the database exists)
            $occupancy_data = StoreOccupancyData::where('store_id', $store->store_id)->first();
            if($occupancy_data != null)
            {
                // Initiating counters and the temporal array
                $counter_enter = 0;
                $counter_exit = 0;
                $new_array = [0, 0, 0, 0, 0, 0,
                                0, 0, 0, 0, 0, 0,
                                0, 0, 0, 0, 0, 0,
                                0, 0, 0, 0, 0, 0];

                // Iterating through time spans (hours in the day)
                for($i = 0; $i < 24; $i++)
                {
                    // Iterating through each appointment
                    foreach ($appointments as $appointment) {
                        $hour_of_entrance = date("H", strtotime($appointment->store_entered_at));
                        $hour_of_exit = date("H", strtotime($appointment->store_exited_at));

                        if($i == $hour_of_entrance)
                        {
                            $counter_enter++;
                        }
                        if($i == $hour_of_exit)
                        {
                            $counter_exit++;
                        }
                    }

                    // Calculating new value for the customer density array
                    $new_array[$i] = ($counter_enter * 0.2) + ($occupancy_data->array_customer_density[$i] * 0.8);
                    // Updating counters
                    $counter_enter = $counter_enter - $counter_exit;
                    $counter_exit = 0;
                }

                // Storing the newly updated array
                $occupancy_data->array_customer_density = $new_array;
                $occupancy_data->save();
            }

            // ==== STATISTICAL DATA UPDATE ====
            // Fetching the statistical data (if the row in the database exists)
            $statistical_data = StoreStatisticalData::where('store_id', $store->store_id)->first();
            if($statistical_data != null)
            {
                $avg_customers = $statistical_data->avg_customers;
                $avg_time_spent_min = $statistical_data->avg_time_spent_min;
                $n_customers = $statistical_data->n_customers;
                $n_days = $statistical_data->n_days;

                // Counting today's appointments
                $today_customers = $appointments->count();

                // Calculating new average customers value
                $new_avg_customers = (($avg_customers * $n_days) + ($today_customers * 1)) / ($n_days + 1);

                // Calculating durations for each appointment
                $durations = [];
                foreach ($appointments as $appointment)
                {
                    $appointment_start_time = strtotime($appointment->store_entered_at);
                    $appointment_end_time = strtotime($appointment->store_exited_at);
                    $appointment_duration_sec = $appointment_end_time - $appointment_start_time;
                    $appointment_duration_min = ($appointment_duration_sec - ($appointment_duration_sec % 60)) / 60;
                    array_push($durations, $appointment_duration_min);
                }
                // Calculating average time spent for today
                $today_average_time_spent_min = 0;
                if(count($durations) != 0)
                {
                    $today_average_time_spent_min = round ((array_sum($durations)/count($durations)), 0, PHP_ROUND_HALF_UP);
                }

                // Calculating new average time spent in minutes
                $new_average_time_spent_min = 0;
                if(($n_customers + $today_customers) != 0)
                {
                    $new_average_time_spent_min = (($avg_time_spent_min * $n_customers) + ($today_average_time_spent_min * $today_customers)) / ($n_customers + $today_customers);
                }

                // Calculating new total number of customers
                $new_n_customers = $n_customers + $today_customers;

                // Calculating new total number of tracked days
                $new_n_days = $n_days + 1;

                // Storing new values
                $statistical_data->avg_customers = $new_avg_customers;
                $statistical_data->avg_time_spent_min = $new_average_time_spent_min;
                $statistical_data->n_customers = $new_n_customers;
                $statistical_data->n_days = $new_n_days;
                $statistical_data->save();
            }
        }
    }
}
