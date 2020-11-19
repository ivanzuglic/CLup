<?php

namespace App\Http\Controllers\Store;

use App\WorkingHours;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WorkingHoursController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = Auth::user();

    }

    /**
     * Create a new store instance.
     *
     * @param  array  $data
     * @return WorkingHours
     */
    public function create (array $data)
    {
        return WorkingHours::create([
            'store_id' => $data['store_id'],
            'day' => $data['day'],
            'opening_hours' => $data['opening_hours'],
            'closing_hours' => $data['closing_hours'],
        ]);
    }

    public function edit ()
    {

    }

    public function update ()
    {

    }
}
