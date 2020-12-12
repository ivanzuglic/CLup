<?php

namespace App\Listeners;

use App\Events\UserCredentialsUpdateEvent;
use App\Notifications\UserCredentialsUpdateNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserCredentialsUpdateListener
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
     * @param  UserCredentialsUpdateEvent  $event
     * @return void
     */
    public function handle(UserCredentialsUpdateEvent $event)
    {
        $user = $event->user;

        $user->notify(new UserCredentialsUpdateNotification($user));
    }
}
