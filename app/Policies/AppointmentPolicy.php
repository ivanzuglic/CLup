<?php

namespace App\Policies;

use App\User;
use App\Appointment;
use App\Roles;
use Illuminate\Auth\Access\HandlesAuthorization;

class AppointmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the appointment.
     *
     * @param  \App\User  $user
     * @param  \App\Appointment  $appointment
     * @return mixed
     */
    public function view(User $user, Appointment $appointment)
    {
        return true;
    }

    /**
     * Determine whether the user can create appointments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $store_manager_role = Roles::where('role_name','store_manager')->firstOrFail();
        $customer_role = Roles::where('role_name','customer')->firstOrFail();
        return ($user->role_id === $customer_role->id) || ($user->role_id === $store_manager_role->id);
    }

    /**
     * Determine whether the user can update the appointment.
     *
     * @param  \App\User  $user
     * @param  \App\Appointment  $appointment
     * @return mixed
     */
    public function update(User $user, Appointment $appointment)
    {
        return $user->id === $appointment->user_id;
    }

    /**
     * Determine whether the user can delete the appointment.
     *
     * @param  \App\User  $user
     * @param  \App\Appointment  $appointment
     * @return mixed
     */
    public function delete(User $user, Appointment $appointment)
    {
        return $user->id === $appointment->user_id;
    }

    /**
     * Determine whether the user can restore the appointment.
     *
     * @param  \App\User  $user
     * @param  \App\Appointment  $appointment
     * @return mixed
     */
    public function restore(User $user, Appointment $appointment)
    {
        $admin_role = Roles::where('role_name','admin')->firstOrFail();
        return $user->role_id === $admin_role->id;
    }

    /**
     * Determine whether the user can permanently delete the appointment.
     *
     * @param  \App\User  $user
     * @param  \App\Appointment  $appointment
     * @return mixed
     */
    public function forceDelete(User $user, Appointment $appointment)
    {
        $admin_role = Roles::where('role_name','admin')->firstOrFail();
        return $user->role_id === $admin_role->id;
    }
}
