<?php

namespace App\Listeners;

use App\Events\QueueCreatedEvent;

use App\Notifications\QueueCreatedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        $appointment = $event->appointment;
        $store = $event->store;

        $user->notify(new QueueCreatedNotification($user, $appointment, $store));
    }
}
