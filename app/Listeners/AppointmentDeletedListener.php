<?php

namespace App\Listeners;

use App\Appointment;
use App\Events\AppointmentDeletedEvent;
use App\Notifications\EarlierTimeslotAvailableNotification;
use App\Store;
use App\User;

class AppointmentDeletedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AppointmentDeletedEvent  $event
     * @return void
     */
    public function handle(AppointmentDeletedEvent $event)
    {
        // Fetching the finished appointment and the store
        $appointment = Appointment::findOrFail($event->appointment_id);
        $store = Store::findOrFail($appointment->store_id);
        // Finding appointments further down the lane that potentially can move forward (only type 2 - queue)
        $next_appointments = Appointment::where('lane', $appointment->lane)
            ->where('start_time', '>=', $appointment->end_time)
            ->where('appointment_type', 2)
            ->where('date', $appointment->date)
            ->where('active', 1)
            ->get();

        foreach($next_appointments as $appointment)
        {
            $customer = User::findOrFail($appointment->user_id);
            $customer->notify(new EarlierTimeslotAvailableNotification($customer, $store, $appointment));
        }
    }
}
