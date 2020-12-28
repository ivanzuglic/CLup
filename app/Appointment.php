<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    public $timestamps = true;

    protected $table = 'appointments';
    protected $primaryKey = 'appointment_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'store_id', 'appointment_type',
        'start_time', 'end_time', 'active', 'in_store', 'date', 'done',
        'lane'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'store_id' => 'integer',
        'appointment_type' => 'integer',
        'in_store' => 'integer',
        'done' => 'integer',
        'lane' => 'integer'
    ];

    /**
     * @return BelongsTo
     */
    public function store()
    {
        return $this->belongsTo('App\Store', 'store_id');
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}

