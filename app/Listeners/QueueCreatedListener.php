<?php

namespace App\Listeners;

use App\Events\QueueCreatedEvent;
use App\Notifications\QueueCreatedNotification;

class QueueCreatedListener
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
     * @param  QueueCreatedEvent  $event
     * @return void
     */
    public function handle(QueueCreatedEvent $event)
    {
        $user = $event->user;
        $store = $event->store;
        $appointment = $event->appointment;

        $user->notify(new QueueCreatedNotification($user, $store, $appointment));
    }
}
