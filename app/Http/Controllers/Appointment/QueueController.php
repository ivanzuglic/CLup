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
        foreach ($store->getAppointmentsInLane(1) as $appointment){
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
            'store_id' => 'required|integer|exists:stores,store_id'
        ]);

        if($validator->fails())
        {
            //return view();
        }

        else
        {
            return $this->store($request);
        }

    }

    public function addUserToQueue(Request $request)
    {

        $store = Store::where('store_id', $request->store_id)->first();
        $queue_ends = $store->getLaneEnds($store->max_occupancy);

        $working_hours = $store->working_hours;
        $today_working_hours = $working_hours->where('day', date('w')-1)->first();
        $min = $today_working_hours->closing_hours;
        $lane = 1;
        $min_start_time = $request->travel_time*60 + strtotime(date('H:i:s'));


        for($i=1; $i<=$store->max_occupancy; $i++)
        {
            $end = $queue_ends[$i];
           if($end != NULL) {
               if (strtotime($end->end_time) < strtotime($min)) {
                   if (strtotime($end->end_time) >= $min_start_time) {
                       $min = $end->end_time;
                       $lane = $end->lane;
                   }
               }
           }
           else
               {
                   $min = date('H:i:s',$min_start_time);
                   $lane = $queue_ends[$i-1]->lane;
                   $lane++;
                   break;
               }
        }

        $end_time = strtotime($min) + $request->planned_stay_time*60;
        $end_time = date('H:i:s', $end_time);

        $appointment = [
            'user_id' => Auth::user()->id,
            'store_id' => $request->store_id,
            'appointment_type' => '2',
            'start_time' => $min,
            'end_time' => $end_time,
            'status' => 'waiting',
            'lane' => $lane,
        ];

        $validator = Validator::make($appointment, [
            'appointment_type' => 'required|integer|exists:appointment_types,type_id',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s|after:start_time',
            'in_store' => 'required|integer|min:0|max:1',
            'done' => 'required|integer|min:0|max:1',
            'lane' => 'required|integer|min:1'
        ]);

        if($validator->fails())
        {
            //return view();
        }

        Appointment::create($appointment);

        return back();
    }
}
