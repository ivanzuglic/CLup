<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function store()
    {
        return $this->belongsTo('App\Store', 'store_id');
    }
}

