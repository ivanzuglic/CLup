<?php

namespace App\Listeners;

use App\Events\UserPasswordUpdateEvent;
use App\Notifications\UserPasswordUpdateNotification;

class UserPasswordUpdateListener
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
     * @param  UserPasswordUpdateEvent  $event
     * @return void
     */
    public function handle(UserPasswordUpdateEvent $event)
    {
        $user = $event->user;

        $user->notify(new UserPasswordUpdateNotification($user));
    }
}
