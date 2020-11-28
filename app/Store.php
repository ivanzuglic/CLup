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

    /**
     * App\StoreType relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo('App\StoreType', 'store_type');
    }

    /**
     * Get the working hours for the store.
     */
    public function working_hours()
    {
        return $this->hasMany('App\WorkingHours', 'store_id');
    }

}
