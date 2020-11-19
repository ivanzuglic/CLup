<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingHours extends Model
{
    public $timestamps = true;

    protected $table = 'working_hours';
    protected $primaryKey = 'working_hours_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_id', 'day', 'opening_hours', 'closing_hours'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
