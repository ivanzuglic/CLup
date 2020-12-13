<?php

namespace App\Http\Controllers\Appointment;

use App\Appointment;
use App\Store;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class QueueController extends AppointmentController
{

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $store = Store::where('store_id', 1)->first();

        return $store->getEmptyTimeslots($store->max_occupancy);
//        return $store->getAllAppointments($store->max_occupancy);
//        return $store->getAppointmentsInLane(1);
//        return $store->getLaneHeads($store->max_occupancy);
//        return $store->getLaneEnds($store->max_occupancy);

//        //moving each appointment in lane 1 for 10 minutes
//        foreach ($store->getAppointmentsInLane(1) as $appointment) {
//            $start_time = strtotime($appointment->start_time) + 600;
//            $end_time = strtotime($appointment->end_time) + 600;
//            $appointment->start_time = date('h:i:s', $start_time);
//            $appointment->end_time = date('h:i:s', $end_time);
//            $appointment->save();
//        }
    }

    /**
     * @param Request $request
     * @return Appointment
     */
    public function insertUserAppointment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'integer|nullable',                                                                            // can be NULL (for someone who is queued in front of store)
            'store_id' => 'required|integer|exists:stores,store_id'
        ]);

        if ($validator->fails())
        {
            //return view();
        }
        else
        {
            return $this->store($request);
        }
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function addReservation(Request $request)
    {
        // Validate request
        $request->validate([
            'reservation_start_time' => 'required',
            'reservation_end_time' => 'required|after:reservation_start_time',
            'reservation_date' => 'required|date_format:Y-m-d|after_or_equal:today',
            'store_id' => 'required|exists:stores,store_id',
        ]);

        // Check reservation criteria to determine validity
        $reservation_valid = $this->checkReservationCriteria($request);

        // If reservation is valid, create an appointment
        if($reservation_valid["valid"] == true)
        {
            $appointment = [
                'user_id' => Auth::user()->id,
                'store_id' => $request->store_id,
                'appointment_type' => '1',
                'start_time' => $request->reservation_start_time,
                'end_time' => $request->reservation_end_time,
                'date' => $request->reservation_date,
                'status' => 'waiting',
                'active' => '1',
                'lane' => $reservation_valid["lane"],
            ];

            Appointment::create($appointment);

            return redirect(route('placements', Auth::id()));
        }
        else
        {
            // return view
        }
    }

    /**
     * @param Request $request
     * @return array
     */
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
        // Getting Working Hours collection
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
                    // If the requested day is today
                    if($date == date("Y-m-d"))
                    {
                        // Check whether reservation start time is in the future
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

    /**
     * @param Request $request
     * @param $appointment_id
     * @return RedirectResponse
     */
    public function removeReservation(Request $request, $appointment_id)
    {
        $appointment = Appointment::findOrFail($appointment_id);
   //     $appointment->status = 'done';
        $appointment->active = 0;
        $appointment->save();

        return back();
    }


    /**
     * @param Request $request
     */
    public function addUserToQueue(Request $request)
    {

        $store = Store::where('store_id', $request->store_id)->first();
        $queue_ends = $store->getLaneEnds($store->max_occupancy);

        $working_hours = $store->working_hours;

        if(date('w') == 0)
        {
            $day_of_week = 6;
        }
        else
        {
            $day_of_week = date('w') - 1;
        }

        $today_working_hours = $working_hours->where('day', $day_of_week)->first();
        $min = $today_working_hours->closing_hours;
        $lane = 1;
        $min_start_time = $request->travel_time * 60 + strtotime(date('H:i:s'));


        for ($i = 1; $i <= $store->max_occupancy; $i++) {
            $end = $queue_ends[$i];

            if ($end != NULL) {
                if (strtotime($end->end_time) < strtotime($min)) {
                    if (strtotime($end->end_time) >= $min_start_time) {
                        $min = $end->end_time;
                        $lane = $end->lane;
                    }
                }
            }
            elseif ($queue_ends[1] == null){
                $min = date('H:i:s', $min_start_time);
                $lane = 1;
                break;
            }
            else {
                $min = date('H:i:s', $min_start_time);
                $lane = $queue_ends[$i - 1]->lane;
                $lane++;
                break;
            }
        }

        $end_time = strtotime($min) + $request->planned_stay_time * 60;
        $end_time = date('H:i:s', $end_time);

        $appointment = [
            'user_id' => Auth::user()->id,
            'store_id' => $request->store_id,
            'appointment_type' => '2',
            'start_time' => $min,
            'end_time' => $end_time,
            'date' => date('Y-m-d'),
            'status' => 'waiting',
            'active' => '1',
            'lane' => $lane,
        ];

        $validator = Validator::make($appointment, [
            'appointment_type' => 'required|integer|exists:appointment_types,type_id',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s|after:start_time',
            'date' => 'required|date',
            'in_store' => 'required|integer|min:0|max:1',
            'active' => 'required|boolean',
            'done' => 'required|integer|min:0|max:1',
            'lane' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            //return view();
        }

        Appointment::create($appointment);

        return redirect(route('placements', Auth::id()));
    }

    public function removeUserFromQueue($appointment_id)
    {
        $appointment = Appointment::findOrFail($appointment_id);
        $appointment->active = 0;
        $appointment->save();

        $store_id = $appointment->store_id;
        $store = Store::find($store_id);

        $proxyCustomers = $store->getProxyCustomersAfterTime($appointment->start_time);
        if ($proxyCustomers == null) {
            return back();
        }
        $canceled_timeslot = strtotime($appointment->end_time) - strtotime($appointment->start_time);

        foreach ($proxyCustomers as $customer) {
            $proxy_timeslot = strtotime($customer->end_time) - strtotime($customer->start_time);

            if ($proxy_timeslot <= $canceled_timeslot) {
                $customer->start_time = $appointment->start_time;
                $end_time = strtotime($customer->start_time) + $proxy_timeslot;
                $customer->end_time = date('H:i:s', $end_time);
                $customer->lane = $appointment->lane;
                $customer->save();
                break;
            }
        }
        $this->rebalanceProxyUsers($store_id, $appointment);

        return back();
    }

    public function rebalanceProxyUsers(int $store_id, Appointment $canceled_appointment)
    {
        $store = Store::find($store_id);
        $working_hours = $store->working_hours;
        $today_working_hours = $working_hours->where('day', date('w') - 1)->first();

        $proxyCustomers = $store->getProxyCustomersAfterTime($canceled_appointment->start_time);

        foreach ($proxyCustomers as $customer) {
            $planned_stay = strtotime($customer->end_time) - strtotime($customer->start_time);

            $empty_timeslots_in_lanes = $store->getEmptyTimeslots($store->max_occupancy, $today_working_hours->opening_hours, $today_working_hours->closing_hours);
            $first_empty_in_lanes = [];
            for ($i = 1; $i <= sizeof($empty_timeslots_in_lanes); $i++) {
                $lane = $empty_timeslots_in_lanes[$i];

                for ($j = 0; $j < sizeof($lane); $j++) {
                    if (strtotime($lane[$j]['end']) > strtotime(date('H:i:s'))) {
                        if (strtotime($lane[$j]['start']) <= strtotime(date('H:i:s')))
                            $lane[$j]['start'] = date('H:i:s');
                        $slot_duration = strtotime($lane[$j]['end']) - strtotime($lane[$j]['start']);

                        if ($slot_duration >= $planned_stay) {
                            $first_empty_in_lanes[$i] = $lane[$j];
                            break;
                        }

                    }
                }
            }
            if ($first_empty_in_lanes != null) {
                $min = $customer->start_time;
                $lane_no = $customer->lane;

                foreach ($first_empty_in_lanes as $key => $lane) {
                    if (strtotime($lane['start']) < strtotime($min)) {
                        $min = $lane['start'];
                        $lane_no = $key;
                    }
                }

                $customer->start_time = $min;
                $end_time = strtotime($min) + $planned_stay;
                $customer->end_time = date('H:i:s', $end_time);
                $customer->lane = $lane_no;
                $customer->save();
            }

        }
    }
}
