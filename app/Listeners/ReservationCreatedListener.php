<?php

namespace App\Listeners;

use App\Events\ReservationCreatedEvent;
use App\Notifications\ReservationCreatedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        $appointment = $event->appointment;
        $store = $event->store;

        $user->notify(new ReservationCreatedNotification($user, $appointment, $store));
    }
}
