<?php

namespace App\Http\Controllers\Appointment;

use App\Appointment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'appointment_type' => 'required|integer|exists:appointment_types,type_id',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s|after:start_time',
            'date' => 'required|date',
            'in_store' => 'required|integer|min:0|max:1',
            'active' => 'required|boolean',
            'done' => 'required|integer|min:0|max:1',
            'lane' => 'required|integer|min:1'
        ]);

        return Appointment::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Appointment $appointment_id
     * @return Appointment
     */
    public function show($appointment_id)
    {
        return Appointment::findOrFail($appointment_id);
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
            'appointment_type' => 'integer|exists:appointment_types,type_id',
            'start_time' => 'date_format:H:i:s',
            'end_time' => 'date_format:H:i:s|after:start_time',
            'in_store' => 'min:0|max:1',
            'active' => 'boolean',
            'done' => 'min:0|max:1',
            'lane' => 'integer|min:1'
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

    public function getActiveAppointmentsForUser()
    {
        $queues = Appointment::where('user_id', Auth::user()->id)->where('appointment_type', 2)->with('store')->where('active', 1)->get();
        $reservations = Appointment::where('user_id', Auth::user()->id)->where('appointment_type', 1)->with('store')->where('active', 1)->get();

        return view('customer_views.placement-view', compact('queues', 'reservations'));

    }

}
