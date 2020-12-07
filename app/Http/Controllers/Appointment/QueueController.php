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
            'store_id' => 'required|integer',// |exists:stores,store_id'    // need to merge with CLUP-108 branch to take effect
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
}
