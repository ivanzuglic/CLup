<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    public $timestamps = true;

    protected $table = 'stores';
    protected $primaryKey = 'store_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'store_type', 'address_line_1',
        'address_line_2', 'zip_code', 'town', 'country',
        'image_reference', 'max_occupancy',
        'current_occupancy', 'max_reservation_ratio'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'store_type' => 'integer',
        'max_occupancy' => 'integer',
        'current_occupancy' => 'integer',
        'max_reservation_ratio' => 'double'
    ];
}
