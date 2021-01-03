<?php

namespace App\Http\Controllers\Appointment;

use App\Appointment;
use App\Events\CustomerEntersStore;
use App\Http\Controllers\Controller;
use App\Store;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AppointmentController extends Controller
{
    private $user;

    /**
     * AppointmentController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->user = Auth::user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Appointment::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
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
     * @param $appointment_id
     * @return Application|Factory|RedirectResponse|Redirector|View
     */
    public function show($appointment_id)
    {
        $user_id = Auth::id();
        $appointment = Appointment::findOrFail($appointment_id);

        if($appointment->user_id == $user_id)
        {
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
        else
        {
            return redirect('/not_available');
        }
    }

    /**
     * @param $appointment_id
     * @return Application|Factory|View|string
     */
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
                    $appointment->save();

                    $message = 'The client may enter the store!';

                    return view('qr_response_views.successResponse', compact('message'));
                }
            }
            else {
                $appointment->status = 'in store';
                $appointment->save();

                $message = 'The client may enter the store!';

                return view('qr_response_views.successResponse', compact('message'));
            }
        }
        else if($appointment->status == 'in store'){
            $appointment->status = 'done';
            $appointment->save();

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param $appointment_id
     * @return Appointment
     */
    public function edit($appointment_id)
    {
        // return edit field
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $appointment_id
     * @return Response
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
     * @param $appointment_id
     * @return int
     */
    public function destroy($appointment_id)
    {
        $appointment = Appointment::findOrFail($appointment_id);
        $appointment->delete();

        return 204;
    }

    /**
     * @param $user_id
     * @return Application|Factory|RedirectResponse|Redirector|View
     */
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

    /**
     * @return Application|Factory|View
     */
    public function QrResponse(){
        return view('qr_response_views.errorResponse');
    }

    /**
     * @param $appointment_id
     * @return mixed
     */
    public function print_ticket($appointment_id)
    {
        $paper_size = [0, 0, 227.00, 340.00];

        $user = Auth::user();
        $appointment = Appointment::findOrFail($appointment_id);

        // Proxy ticket (accessible to manager)
        if($appointment->user_id == null)
        {
            // Manager must be from the same store as the ticket is
            if($appointment->store_id == $user->store_id)
            {
                // Generating QR-code
                $qr = QrCode::size(200)->generate(url('/scan/').'/'.$appointment_id);
                // Generating ticket in PDF format
                $pdf = PDF::loadView('pdf.print_ticket', compact('appointment', 'qr'));
                // Returning the generated PDF
                return $pdf->setPaper($paper_size)->stream('invoice.pdf');
            }
            else
            {
                return redirect('/not_available');
            }
        }
        // User ticket (accessible to customers)
        else
        {
            // User must be the owner of the ticket
            if($appointment->user_id == $user->id)
            {
                // Generating QR-code
                $qr = QrCode::size(200)->generate(url('/scan/').'/'.$appointment_id);
                // Generating ticket in PDF format
                $pdf = PDF::loadView('pdf.print_ticket', compact('appointment', 'qr'));
                // Returning the generated PDF
                return $pdf->setPaper($paper_size)->stream('invoice.pdf');
            }
            else
            {
                return redirect('/not_available');
            }
        }
    }
}
