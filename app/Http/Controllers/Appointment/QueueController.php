<?php


namespace App\Http\Controllers\Appointment;

use App\Appointment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Appointment\AppointmentController;


class QueueController extends AppointmentController
{

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
