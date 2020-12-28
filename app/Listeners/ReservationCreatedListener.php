<?php

namespace App\Listeners;

use App\Events\ReservationCreatedEvent;
use App\Notifications\ReservationCreatedNotification;

class ReservationCreatedListener
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
     * @param  ReservationCreatedEvent  $event
     * @return void
     */
    public function handle(ReservationCreatedEvent $event)
    {
        $user = $event->user;
        $store = $event->store;
        $appointment = $event->appointment;

        $user->notify(new ReservationCreatedNotification($user, $store, $appointment));
    }
}
