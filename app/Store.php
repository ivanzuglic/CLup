<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'stores';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'store_type', 'address',
        'image_reference', 'max_occupancy',
        'current_occupancy', 'max_reservation_ratio'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
