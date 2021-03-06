<?php

namespace App\Providers;

use App\Roles;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',

        'App\Store' => 'App\Policies\StorePolicy',
        'App\WorkingHours' => 'App\Policies\WorkingHoursPolicy',

        'App\Appointment' => 'App\Policies\AppointmentPolicy',

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerManagerPolicies();

    }

    /**
     * Register authorization services for Managers.
     *
     * @return void
     */
    public function registerManagerPolicies()
    {
        /**
         * Gate for Manager Registration (in ManagerRegisterController).
         * Only Admins can register managers.
         */
        Gate::define('ManagerRegister', function($user) {
            $admin_role = Roles::where('role_name', 'admin')->firstOrFail();
            return $user->role_id === $admin_role->id;
        });

        // other gates for Manager
    }
}
