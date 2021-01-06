<?php

namespace App\Listeners;

use App\Appointment;
use App\Events\StoreExitedEvent;
use App\Notifications\StoreEnterableNotification;
use App\Store;
use App\User;

class StoreExitedListener
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
     * @param  StoreExitedEvent  $event
     * @return void
     */
    public function handle(StoreExitedEvent $event)
    {
        // Fetching the finished appointment and the store
        $appointment = Appointment::findOrFail($event->appointment_id);
        $store = Store::findOrFail($appointment->store_id);
        // Finding the next appointment in the lane
        $next_appointment = Appointment::where('lane', $appointment->lane)->where('start_time', '>=', $appointment->end_time)->where('date', $appointment->date)->where('active', 1)->first();

        // If the next appointment is a queue entry by a customer using the application
        if($next_appointment != null)
        {
            if($next_appointment->appointment_type == 2)
            {
                $next_customer = User::findOrFail($next_appointment->user_id);
                $next_customer->notify(new StoreEnterableNotification($next_customer, $store, $next_appointment));
            }
        }
    }
}
