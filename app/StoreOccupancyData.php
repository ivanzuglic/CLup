<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoreOccupancyData extends Model
{
    protected $table = 'store_occupancy_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_id',
        'array_customer_density'
    ];

    /**
     * Attributes casts
     *
     * @var string[]
     */
    protected $casts = [
        'store_id' => 'integer',
        'array_customer_density' => 'array'
    ];

    /**
     * @return BelongsTo
     */
    public function store()
    {
        return $this->belongsTo('App\Store', 'store_id');
    }
}
