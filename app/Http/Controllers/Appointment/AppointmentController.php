<?php

namespace App\Http\Controllers\Appointment;

use App\Appointment;
use App\Events\CustomerEntersStore;
use App\Http\Controllers\Controller;
use App\Store;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AppointmentController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Appointment::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Appointment
     */
    public function store(Request $request)
    {
        $request->validate([
            'store_id' => 'required|integer|exists:stores,store_id',
            'user_id' => 'integer|exists:users,id',
            'appointment_type' => 'required|integer|exists:appointment_types,type_id',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s|after:start_time',
            'date' => 'required|date',
            'status' => 'required|in:waiting,in store,done',
            'active' => 'required|boolean',
            'lane' => 'required|integer|min:1'
        ]);

        return Appointment::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Appointment $appointment_id
     */
    public function show($appointment_id)
    {
        $appointment = Appointment::find($appointment_id);

        $store = Store::where('store_id', $appointment->store_id)->with('type')->with('working_hours')->first();

        $appointment_day_of_week = date("w", strtotime($appointment->date));
        if($appointment_day_of_week == 0)
        {
            $appointment_day_of_week == 6;
        }
        else
        {
            $appointment_day_of_week--;
        }

        $qr = QrCode::size(300)->generate(url('/scan/').'/'.$appointment_id);

        return view('customer_views.ticket-view', compact('appointment', 'appointment_day_of_week', 'store', 'qr'));
    }

    public function scan($appointment_id)
    {
        $appointment = Appointment::where('appointment_id', $appointment_id)->first();
        $message = '';

        if ($appointment->status == 'waiting') {
            $store = Store::find($appointment->store_id);
            $appointment_before = $store->getAppointmentBefore($appointment);

            if ($appointment_before != null) {
                if ($appointment_before->status != 'done') {
                    $message = 'The client may not enter the store yet!';

                    return view('qr_response_views.warningResponse', compact('message'));
                }
                else{
                    $appointment->status = 'in store';
                    $appointment->store_entered_at = date('H:i:s');
                    $appointment->save();

                    $message = 'The client may enter the store!';

                    return view('qr_response_views.successResponse', compact('message'));
                }
            }
            else {
                $appointment->status = 'in store';
                $appointment->store_entered_at = date('H:i:s');
                $appointment->save();

                $message = 'The client may enter the store!';

                return view('qr_response_views.successResponse', compact('message'));
            }
        }
        else if($appointment->status == 'in store'){
            $appointment->status = 'done';
            $appointment->store_exited_at = date('H:i:s');
            $appointment->save();

            if (strtotime($appointment->store_exited_at) > strtotime($appointment->end_time))
                $this->pushBackLaneAfterLateAppointment($appointment);

            $message = 'The client left the store!';

            return view('qr_response_views.successResponse', compact('message'));
        }
        else if($appointment->status == 'done'){
            $message = 'The client had already left the store!';

            return view('qr_response_views.errorResponse', compact('message'));
        }

        $user = Auth::user();
        event(new CustomerEntersStore($appointment, $message, $user));
        return $message;
    }

    //pushing back appointments in lane where customer stays longer then anticipated
    public function pushBackLaneAfterLateAppointment($appointment)
    {
        $late = strtotime($appointment->store_exited_at) - strtotime($appointment->end_time);
        $store = $appointment->store;
        if(date('w') == 0)
            $day_of_week = 6;
        else
            $day_of_week = date('w') - 1;
        $working_hours = $store->working_hours->where('day', $day_of_week);
        $appointments = Appointment::where('lane', $appointment->lane)->where('start_time', '>=', $appointment->end_time)->where('date', $appointment->date)->where('active', 1)->get();

        for ($i = 0; $i < sizeof($appointments); $i++) {
            //reservations cannot be pushed back unless late appointment is right before it in that lane
            if ($appointments[$i]->type->appointment_type == 'Reservation'){
                if ($i == 0){
                    $this->changeAppointmentTime($appointments[$i], $late, $working_hours[$day_of_week]);
                }else {
                    continue;
                }
            }
            // if it's not the last appointment in lane, check if following appointment is reservation
            if ($i+1 != sizeof($appointments)){
                // if the following appointment is not reservation, appointment is pushed back normally
                if ($appointments[$i+1]->type->appointment_type != 'Reservation'){
                    $this->changeAppointmentTime($appointments[$i], $late, $working_hours[$day_of_week]);
                }
                // if the following appointment is a reservation, pushing back depends
                else {
                    // if pushing back appointment overlaps with reservation, it is pushed back after it
                    if (strtotime($appointments[$i]->end_time) + $late > strtotime($appointments[$i+1]->start_time)){
                        $late = strtotime($appointments[$i+1]->end_time) - strtotime($appointments[$i]->start_time);
                    }
                    $this->changeAppointmentTime($appointments[$i], $late, $working_hours[$day_of_week]);
                    $late = strtotime($appointments[$i]->end_time) - strtotime($appointments[$i]->start_time);
                }
            }
            // if it is the last appointment, push it back
            else {
                $this->changeAppointmentTime($appointments[$i], $late, $working_hours[$day_of_week]);
            }
        }
    }

    // changing start time and end time of appointment for certain late value
    public function changeAppointmentTime($appointment, $late, $working_hours)
    {
        //if changed start time is larger then closing hours, redirects back with error
        if (strtotime($appointment->start_time) + $late > strtotime($working_hours->closing_hours))
            return Redirect::back()->withErrors('Some customers fall out of queue');
        //if not adds late value to start
        else
            $appointment->start_time = date('H:i:s', (strtotime($appointment->start_time) + $late));
        //if changed end time is smaller then closing hours, it changes
        if (strtotime($appointment->end_time) + $late <= strtotime($working_hours->closing_hours))
            $appointment->end_time = date('H:i:s', (strtotime($appointment->end_time) + $late));
        //if not, end time is set to closing hours
        else
            $appointment->end_time = $working_hours->closing_hours;
        $appointment->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $appointment_id
     * @return Appointment
     */
    public function edit($appointment_id)
    {
        // return edit field
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointment_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $appointment_id)
    {
        $request->validate([
            'store_id' => 'required|integer|exists:stores,store_id',
            'user_id' => 'integer|exists:users,id',
            'appointment_type' => 'required|integer|exists:appointment_types,type_id',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s|after:start_time',
            'date' => 'required|date',
            'status' => 'required|in:waiting,in store,done',
            'active' => 'required|boolean',
            'lane' => 'required|integer|min:1'
        ]);

        $appointment = Appointment::findOrFail($appointment_id);
        $appointment->update($request->all());

        return $appointment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appointment  $appointment_id
     * @return int
     */
    public function destroy($appointment_id)
    {
        $appointment = Appointment::findOrFail($appointment_id);
        $appointment->delete();

        return 204;
    }

    public function getActiveAppointmentsForUser($user_id)
    {
        if($user_id == Auth::id())
        {
            $queues = Appointment::where('user_id', Auth::id())->where('appointment_type', 2)->with('store')->where('active', 1)->get();
            $reservations = Appointment::where('user_id', Auth::id())->where('appointment_type', 1)->with('store')->where('active', 1)->get();

            return view('customer_views.placement-view', compact('queues', 'reservations'));
        }
        else
        {
            return redirect(route('placements', Auth::id()));
        }
    }

    public function QrResponse(){
        return view('qr_response_views.errorResponse');
    }

    public function print_ticket($appointment_id)
    {
        $paper_size = [0, 0, 227.00, 340.00];

        $appointment = Appointment::findOrFail($appointment_id);
        $qr = QrCode::size(200)->generate(url('/scan/').'/'.$appointment_id);

        $pdf = PDF::loadView('pdf.print_ticket', compact('appointment', 'qr'));
        return $pdf->setPaper($paper_size)->stream('invoice.pdf');
    }

}
