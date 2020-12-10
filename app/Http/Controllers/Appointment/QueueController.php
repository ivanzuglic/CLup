<?php


namespace App\Http\Controllers\Appointment;

use App\Appointment;
use App\Http\Controllers\Controller;
use App\Store;
use App\StoreType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Appointment\AppointmentController;


class QueueController extends AppointmentController
{

    public function index()
    {
        $store = Store::where('store_id', 1)->first();

//        return $store->getAllAppointments($store->max_occupancy);
//        return $store->getAppointmentsInLane(1);
//        return $store->getLaneHeads($store->max_occupancy);
//        return $store->getLaneEnds($store->max_occupancy);

        //moving each appointment in lane 1 for 10 minutes
        foreach ($store->getAppointmentsInLane(1) as $appointment) {
            $start_time = strtotime($appointment->start_time) + 600;
            $end_time = strtotime($appointment->end_time) + 600;
            $appointment->start_time = date('h:i:s', $start_time);
            $appointment->end_time = date('h:i:s', $end_time);
            $appointment->save();
        }
    }

    public function insertUserAppointment(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'integer|nullable',                            // can be NULL (for someone who is queued in front of store)
            'store_id' => 'required|integer',// |exists:stores,store_id'    // need to merge with CLUP-108 branch to take effect
        ]);

        if ($validator->fails()) {
            //return view();
        } else {
            return $this->store($request);
        }

    }

    public function addReservation(Request $request)
    {

        $reservation_valid = $this->checkReservationCriteria($request);
        dd($reservation_valid);
    }

    private function checkReservationCriteria(Request $request)
    {
        // If 0 -> reservation criteria not fulfilled
        // else -> lane in which to add the reservation
        $return_lane = -1;

        $start_time = $request->reservation_start_time;
        $end_time = $request->reservation_end_time;
        $date = $request->reservation_date;
        $store_id = $request->store_id;

        if(date('w', strtotime($date)) == 0)
        {
            $day_of_week = 6;
        }
        else
        {
            $day_of_week = date('w', strtotime($date)) - 1;
        }

        // Fetching store from DB
        $store = Store::where('store_id', $store_id)->first();
        // Geting Working Hours collection
        $working_hours_col = $store->working_hours;

        // Check whether reservation date is valid (today or after)
        if($date >= date("Y-m-d"))
        {
            // Check whether end time is after start time
            if(strtotime($start_time) < strtotime($end_time))
            {
                // Getting working hours of the store for $day_of_the_week (if open)
                $working_hours = $working_hours_col->where('day', $day_of_week)->first();
                if($working_hours === null)
                {
                    return array("valid"  => false, "lane" => $return_lane);
                }

                // Check whether reservation start time is valid (after opening hours on the requested day)
                // Check whether reservation end time is valid (before closing hours on the requested day)
                if((strtotime($start_time) >= strtotime($working_hours->opening_hours))
                    && (strtotime($end_time) <= strtotime($working_hours->closing_hours)))
                {
                    //Check whether reservation start time is in the future (if the requested day is today)
                    if($date == date("Y-m-d"))
                    {
                        if(strtotime($start_time) < strtotime(date('H:i:s')))
                        {
                            return array("valid"  => false, "lane" => $return_lane);
                        }
                    }

                    //Check whether there are free slots at the desired time and date
                    //Check whether reservation ratio is honored
                    $overlapping_appointments = $store->getAllOverlappingAppointments($store->max_occupancy, $date, $start_time, $end_time);

                    $empty_lines = 0;
                    $filled_lines = 0;
                    $reservations = 0;
                    $iterator = 0;

                    foreach ($overlapping_appointments as $lane)
                    {
                        $iterator++;

                        if($lane->isEmpty())
                        {
                            $empty_lines++;
                            $return_lane = $iterator;
                        }
                        else
                        {
                            $filled_lines++;
                            foreach ($lane as $appointment)
                            {
                                if($appointment->appointment_type === 1)
                                {
                                    $reservations++;
                                }
                            }
                        }
                    }

                    //dd([$empty_lines, $filled_lines, $reservations]);

                    $reservation_ratio = ($reservations + 1) / $store->max_occupancy;

                    if($reservation_ratio <= $store->max_reservation_ratio && $empty_lines > 0)
                    {
                        return array("valid"  => true, "lane" => $return_lane);
                    }
                    else
                    {
                        return array("valid"  => false, "lane" => $return_lane);
                    }
                }
                else
                {
                    return array("valid"  => false, "lane" => $return_lane);
                }
            }
            else
            {
                return array("valid"  => false, "lane" => $return_lane);
            }
        }
        else
        {
            return array("valid"  => false, "lane" => $return_lane);
        }
    }
}
