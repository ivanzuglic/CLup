<?php

namespace App\Http\Controllers\Store;

use App\Appointment;
use App\Store;
use App\StoreOccupancyData;
use App\StoreStatisticalData;
use App\StoreType;
use App\WorkingHours;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->middleware('auth');
        $this->user = Auth::user();
    }

    public function index()
    {
        $sql = <<<SQL
SELECT DISTINCT UPPER(s.country) AS country
FROM stores s
SQL;
        $countries = DB::select(DB::raw($sql));

        $sql = <<<SQL
SELECT DISTINCT UPPER(s.town) AS city
FROM stores s
SQL;
        $cities = DB::select(DB::raw($sql));

        $store_types = StoreType::all();

        $store_type = isset($_GET['store_type']) ? $_GET['store_type'] : "";
        $country = isset($_GET['country']) ? $_GET['country'] : "";
        $city = isset($_GET['city']) ? $_GET['city'] : "";
        $search_string = isset($_GET['search_string']) ? $_GET['search_string'] : "";
        $store = (new Store)->newQuery();

        //searching where name, description, country, town or zipcode contain searched string
        $store->where(function ($query) use ($search_string) {
            $query->where('name', 'LIKE', '%' . $search_string . '%')
                ->orWhere('description', 'LIKE', '%' . $search_string . '%')
                ->orWhere('town', 'LIKE', '%' . $search_string . '%')
                ->orWhere('country', 'LIKE', '%' . $search_string . '%')
                ->orWhere('zip_code', 'LIKE', '%' . $search_string . '%');
        })->get();

        //searching where store_type matches selected store type
        if ($store_type != null) {
            $store->where('store_type', $store_type)
                ->get();
        }

        //searching where store_type matches selected store type
        if ($country != null) {
            $store->where('country', 'like', $country)
                ->get();
        }

        //searching where store_type matches selected store type
        if ($city != null) {
            $store->where('town', 'like', $city)
                ->get();
        }

        $stores = $store->with('type')->with(['working_hours' => function ($query) {
            if(date('w') == 0)
            {
                $day_of_week = 6;
            }
            else
            {
                $day_of_week = date('w') - 1;
            }

            $query->where('day', '=', $day_of_week);
        }])->get();

        return view('customer_views.find-store',compact('stores', 'countries', 'cities', 'store_types'));

    }

    public function getCities()
    {
        $country = $_GET['country'];

        $sql = <<<SQL
SELECT DISTINCT UPPER(s.town) AS city
FROM stores s
WHERE s.country LIKE '$country'
SQL;
        return DB::select(DB::raw($sql));

    }

    public function create()
    {
        // return creation field
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'max:1000',
            'store_type' => 'required|integer|exists:store_types,type_id',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'string|nullable|max:255',
            'zip_code' => 'required|string|regex:/\b\d{5}\b/',
            'town' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'image_reference' => '',
            'max_occupancy' => 'required|integer|min:1',
            'current_occupancy' => 'required|integer|in:0',
            'max_reservation_ratio' => 'numeric|min:0.0|max:1.0',
        ]);

        $store = Store::create($request->all());
        app('App\Http\Controllers\Statistics\StoreOccupancyDataController')->initialize($store->store_id);
        app('App\Http\Controllers\Statistics\StoreStatisticalDataController')->initialize($store->store_id);
        return back();
    }

    public function show($store_id)
    {
        return Store::findOrFail($store_id);
    }

    public function show_details($store_id)
    {
        $store = Store::where('store_id', $store_id)->with('type')->with(['working_hours' => function ($query) {
            if(date('w') == 0)
            {
                $day_of_week = 6;
            }
            else
            {
                $day_of_week = date('w') - 1;
            }

            $query->where('day', '=', $day_of_week);
        }])->first();

        $statistical_data = StoreStatisticalData::where('store_id', $store_id)->first();
        $occupancy_data = StoreOccupancyData::where('store_id', $store_id)->first();
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

        return view('customer_views.store-details', array('store' => $store, 'stat_exists' => $stat_exists, 'statistical_data' => $statistical_data, 'occ_exists' => $occ_exists, 'occupancy_array' => $occupancy_array));
    }

    public function edit()
    {
        // return edit field
    }

    public function update(Request $request, $store_id)
    {
        $request->validate([
            'name' => 'string|max:255',
            'description' => 'max:1000',
            'store_type' => 'integer|exists:store_types,type_id',
            'address_line_1' => 'string|max:255',
            'address_line_2' => 'string|max:255',
            'zip_code' => 'string|regex:/\b\d{5}\b/',
            'town' => 'string|max:255',
            'country' => 'string|max:255',
            'image_reference' => '',
            'max_occupancy' => 'integer|min:1',
            'current_occupancy' => 'integer|min:0',
            'max_reservation_ratio' => 'numeric|min:0.0|max:1.0',
        ]);

        $store = Store::findOrFail($store_id);
        $store->update($request->all());

        if($request->hasFile('image_reference')) {
           $filename = $request->image_reference->getClientOriginalName();
           $request->image_reference->storeAs('images',  $filename, 'public');
           $store->update(['image_reference'=>$filename]);
        }

        return back();
    }

    public function destroy(Request $request, $store_id)
    {
        $store = Store::findOrFail($store_id);
        $store->delete();

        return 204;
    }

    // NEW (SCORE) - Luka

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function ajaxGenerateTimelineArray(Request $request)
    {
        // \/ TEMP
        // For testing purposes
        // The precise way of passing arguments still needs to be decided upon
        $store_id = $request->store_id;
        $date = $request->date;
        // /\ TEMP

        // ARRAY LENGTH
        define( "ARR_LENGTH",   "721" );
        // TIMELINE ARRAY VALUES
        define( "AVAILABLE",    "1"   );
        define( "UNAVAILABLE",  "0"   );
        define( "ERROR",        '-1'  );

        // Fetch the store (if it exists in the database)
        $store = Store::findOrFail($store_id);

        // Initializing the final array to available values
        $array_final = array_fill(0, ARR_LENGTH, AVAILABLE);
        $array_appointment_num = array_fill(0, ARR_LENGTH, 0);
        $array_reservation_num = array_fill(0, ARR_LENGTH, 0);

        // Check whether the selected date is valid (today or after today)
        if ($date >= date("Y-m-d")) {

            // Determine the weekday for the selected date
            $weekday = $this->weekday($date);
            // Check if the store is open on a selected weekday
            if($this->isOpen($store_id, $weekday)) {

                // >>-- OPENING AND CLOSING HOURS --<<

                // Fetching the working_hours entry
                $working_hours = $this->workingHoursForWeekday($store_id, $weekday);
                // Determining array relevant data
                $opening_hours_array_data = $this->timeToIndex($working_hours->opening_hours);
                $closing_hours_array_data = $this->timeToIndex($working_hours->closing_hours);

                // Determining indexes for opening and closing hours
                if($opening_hours_array_data["half"]) {
                    $opening_hours_index = $opening_hours_array_data["index"] + 1;
                }
                else {
                    $opening_hours_index = $opening_hours_array_data["index"];
                }
                $closing_hours_index = $closing_hours_array_data["index"];

                // Setting array entries before opening hours and after closing hours as UNAVAILABLE
                for ($i = 0; $i < $opening_hours_index; $i++) {
                    $array_final[$i] = UNAVAILABLE;
                }
                for ($i = $closing_hours_index; $i < ARR_LENGTH; $i++) {
                    $array_final[$i] = UNAVAILABLE;
                }

                // >>-- APPOINTMENTS --<<

                // Fetching all appointments for the selected date
                $appointments_on_date = $this->appointmentsForDate($store_id, $date);

                // Iterating through appointments on selected date
                foreach($appointments_on_date as $appointment) {

                    // Determining array relevant data for an appointment
                    $appointment_start_time_array_data = $this->timeToIndex($appointment->start_time);
                    $appointment_end_time_array_data = $this->timeToIndex($appointment->end_time);

                    // Determining indexes for appointment start_time and end_time
                    $appointment_start_time_index = $appointment_start_time_array_data["index"];
                    $appointment_end_time_index = $appointment_end_time_array_data["index"] + 1;

                    // Incrementing relevant counters in auxiliary arrays
                    for ($i = $appointment_start_time_index; $i < $appointment_end_time_index; $i++) {

                        // Incrementing the number of appointments for the index
                        $array_appointment_num[$i]++;
                        // Incrementing the number of reservations for the index
                        if($appointment->appointment_type == 1) {
                            $array_reservation_num[$i]++;
                        }
                    }
                }

                // Iterating through auxiliary tables
                for($i = 0; $i < ARR_LENGTH; $i++) {

                    // If there are already a max allowed number of appointments in timespan corresponding to index $i, that timespan is UNAVAILABLE
                    if($array_appointment_num[$i] >= $store->max_occupancy) {
                        $array_final[$i] = UNAVAILABLE;
                    }
                    // If there are already a mam allowed number of reservations in timespan corresponding to index $i, that timespan is UNAVAILABLE
                    elseif(($array_reservation_num[$i] + 1) > ($store->max_occupancy * $store->max_reservation_ratio)) {
                        $array_final[$i] = UNAVAILABLE;
                    }
                }

                // >>-- PASSED TIME (IF "TODAY") --<<

                if($date == date("Y-m-d"))
                {
                    // Determining array relevant data for current time
                    $current_time_array_data = $this->timeToIndex(date("H:i"));
                    $current_time_index = $current_time_array_data["index"] + 1;

                    // Setting array entries before current time as UNAVAILABLE
                    for ($i = 0; $i < $current_time_index; $i++) {
                        $array_final[$i] = UNAVAILABLE;
                    }
                }

                // Returning the final array
                return response()->json(array('timeline_array'=> $array_final), 200);
            }
            else {

                // Filling the final array with UNAVAILABLE values
                for ($i = 0; $i < ARR_LENGTH; $i++) {
                    $array_final[$i] = UNAVAILABLE;
                }
                // Returning the final array
                return response()->json(array('timeline_array'=> $array_final), 200);
            }
        }
        else{

            // Filling the final array with ERROR values
            for ($i = 0; $i < ARR_LENGTH; $i++) {
                $array_final[$i] = ERROR;
            }
            // Returning the final array
            return response()->json(array('timeline_array'=> $array_final), 200);
        }
    }

    /**
     * @param $time
     * @return array
     */
    private function timeToIndex ($time)
    {
        // Extracting the hours value from time
        $hours = date("H", strtotime($time));
        // Extracting the minutes value from time
        $minutes = date("i", strtotime($time));

        // Calculating the index
        $double_index_time = $hours * 60 + $minutes;
        $index = ($double_index_time - ($double_index_time % 2)) / 2;

        // Determining half value
        if(($double_index_time % 2) == 1) {
            $half = true;
        }
        else {
            $half = false;
        }

        return array("index" => $index, "half" => $half);
    }

    /**
     * @param $date
     * @return int
     */
    private function weekday($date)
    {
        // Aligning the weekday number with 0 = Mon, 6 = Sun
        if (date('w', strtotime($date)) == 0) {
            $weekday = 6;
        }
        else {
            $weekday = date('w', strtotime($date)) - 1;
        }

        return $weekday;
    }

    /**
     * @param $store_id
     * @param $weekday
     * @return bool
     */
    private function isOpen ($store_id, $weekday)
    {
        // Checking if working_hours entry for a selected weekday exists
        if(WorkingHours::where([['store_id', '=', $store_id], ['day', '=', $weekday]])->exists()) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * @param $store_id
     * @param $weekday
     * @return mixed
     */
    private function workingHoursForWeekday ($store_id, $weekday)
    {
        $working_hours = WorkingHours::where([['store_id', '=', $store_id], ['day', '=', $weekday]])->first();

        return $working_hours;
    }

    private function appointmentsForDate ($store_id, $date)
    {
        $appointments = Appointment::where([['store_id', '=', $store_id], ['date', '=', $date], ['active', '=', 1]])->get();

        return $appointments;
    }
}
