<?php

namespace App\Listeners;

use App\Events\ManagerCreatedEvent;
use App\Notifications\ManagerCreatedNotification;
use App\Store;

class ManagerCreatedListener
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
     * @param  ManagerCreatedEvent  $event
     * @return void
     */
    public function handle(ManagerCreatedEvent $event)
    {
        $manager_user = $event->manager_user;
        $manager_pass_encrypted = $event->manager_pass_encrypted;
        $manager_store = Store::findOrFail($manager_user->store_id);

        $manager_user->notify(new ManagerCreatedNotification($manager_user, $manager_store, $manager_pass_encrypted));
    }
}
