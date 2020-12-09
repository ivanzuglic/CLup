<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\UserRegisteredEvent' => [
            'App\Listeners\UserRegisteredListener',
        ],

        'App\Events\UserCredentialsUpdateEvent' => [
            'App\Listeners\UserCredentialsUpdateListener',
        ],

        'App\Events\UserPasswordUpdateEvent' => [
            'App\Listeners\UserPasswordUpdateListener',
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
