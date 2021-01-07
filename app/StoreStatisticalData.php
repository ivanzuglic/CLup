<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoreStatisticalData extends Model
{
    protected $table = 'store_statistical_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_id',
        'avg_customers',
        'avg_time_spent_min',
        'n_customers',
        'n_days'
    ];

    /**
     * Attributes casts
     *
     * @var string[]
     */
    protected $casts = [
        'store_id' => 'integer',
        'avg_customers' => 'integer',
        'avg_time_spent_min' => 'integer',
        'n_customers' => 'integer',
        'n_days' => 'integer'
    ];

    /**
     * @return BelongsTo
     */
    public function store()
    {
        return $this->belongsTo('App\Store', 'store_id');
    }
}
