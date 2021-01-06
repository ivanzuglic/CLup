<?php

namespace App\Listeners;

use App\Appointment;
use App\Events\StoreExitedEvent;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        // Fetching the finished appointment
        $appointment = Appointment::findOrFail($event->appointment_id);
        // Finding the next appointment in the lane
        $next_appointment = Appointment::where('lane', $appointment->lane)->where('start_time', '>=', $appointment->end_time)->where('date', $appointment->date)->where('active', 1)->first();

        // If the next appointment is a queue entry by a customer using the application
        if($next_appointment->appointment_type == 2)
        {
            $next_customer = User::findOrFail($next_appointment->user_id);
            $user->notify(new ReservationCreatedNotification($user, $store, $appointment));
        }
    }
}
