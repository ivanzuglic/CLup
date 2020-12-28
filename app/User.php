<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'phone_number', 'store_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * App\Role relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Roles', 'role_id');
    }

    public function getAllUserAppointmentsInTimeframe($start_time, $end_time, $date)
    {
        $overlapping_appointments = $this->hasMany('App\Appointment', 'user_id')->where([
            ['active', '=', 1],
            ['date', '=', $date],
            ['start_time', '>=', $start_time],
            ['end_time', '<=', $end_time],
        ])->orWhere([
            ['active', '=', 1],
            ['date', '=', $date],
            ['start_time', '<=', $start_time],
            ['end_time', '>=', $end_time],
        ])->orWhere([
            ['active', '=', 1],
            ['date', '=', $date],
            ['start_time', '>', $start_time],
            ['start_time', '<', $end_time],
        ])->orWhere([
            ['active', '=', 1],
            ['date', '=', $date],
            ['end_time', '>', $start_time],
            ['end_time', '<', $end_time],
        ])->orderBy('start_time')->get();

        return $overlapping_appointments;
    }
}
