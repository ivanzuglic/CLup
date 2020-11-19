<?php

namespace App\Http\Controllers\Store;

use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
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
     * @return Store
     */
    public function create (array $data)
    {
        return Store::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'store_type' => $data['store_type'],
            'address_line_1' => $data['address_line_1'],
            'address_line_2' => $data['address_line_2'],
            'zip_code' => $data['zip_code'],
            'town' => $data['town'],
            'country' => $data['country'],
            'image_reference' => $data['image_reference'],
            'max_occupancy' => $data['max_occupancy'],
            'current_occupancy' => '0',
            'max_reservation_ratio' => '1.0',
        ]);
    }

    public function edit ()
    {

    }

    public function update ()
    {

    }
}
