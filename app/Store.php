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

    /**
     * Get all appointements for the store.
     *
     * @return array
     */
    public function getAllAppointments($max_occupancy)
    {
        $lanes = [];
        for ($i = 1; $i <= $max_occupancy; $i++){
            $lanes[$i] = $this->hasMany('App\Appointment', 'store_id')->where('lane', $i)->orderBy('start_time')->get();
        }
        return $lanes;
    }

    /**
     * Get all appointements for the store at a specific date.
     *
     * @return array
     */
    public function getAllOverlappingAppointments($max_occupancy, $date, $start_time, $end_time)
    {
        $overlapping_appointments = [];
        for ($i = 1; $i <= $max_occupancy; $i++){
            $overlapping_appointments[$i] = $this->hasMany('App\Appointment', 'store_id')->where([
                ['lane', '=', $i],
                ['date', '=', $date],
                ['start_time', '>', $start_time],
                ['end_time', '<', $end_time],
            ])->orWhere([
                ['lane', '=', $i],
                ['date', '=', $date],
                ['start_time', '<', $start_time],
                ['end_time', '>', $end_time],
            ])->orWhere([
                ['lane', '=', $i],
                ['date', '=', $date],
                ['start_time', '>', $start_time],
                ['start_time', '<', $end_time],
            ])->orWhere([
                ['lane', '=', $i],
                ['date', '=', $date],
                ['end_time', '>', $start_time],
                ['end_time', '<', $end_time],
            ])->orderBy('start_time')->get();
        }
        return $overlapping_appointments;
    }

    /**
     * Get the appointements from specific lane for the store.
     *
     */
    public function getAppointmentsInLane($lane)
    {
        return $this->hasMany('App\Appointment', 'store_id')->where('lane', $lane)->orderBy('start_time')->get();
    }

    /**
     * Get the appointements from specific lane for the store.
     *
     */
    public function getLaneHeads($max_occupancy)
    {
        $lanes = [];
        for ($i = 1; $i <= $max_occupancy; $i++){
            $lanes[$i] = $this->hasMany('App\Appointment', 'store_id')->where('lane', $i)->orderBy('start_time')->first();
        }
        return $lanes;
    }

    /**
     * Get the appointements from specific lane for the store.
     *
     */
    public function getLaneEnds($max_occupancy)
    {
        $lanes = [];
        for ($i = 1; $i <= $max_occupancy; $i++){
            $lanes[$i] = $this->hasMany('App\Appointment', 'store_id')->where('lane', $i)->orderBy('start_time', 'desc')->first();
        }
        return $lanes;
    }
}
