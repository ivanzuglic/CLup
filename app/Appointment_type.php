<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment_type extends Model
{
    protected $table = 'appointment_types';
    protected $primaryKey = 'type_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'appointment_type'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
