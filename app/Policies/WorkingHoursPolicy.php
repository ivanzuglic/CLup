<?php

namespace App\Policies;

use App\Roles;
use App\User;
use App\WorkingHours;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkingHoursPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the working hours.
     *
     * @param  \App\User  $user
     * @param  \App\WorkingHours  $workingHours
     * @return mixed
     */
    public function view(User $user, WorkingHours $workingHours)
    {
        return true;
    }

    /**
     * Determine whether the user can create working hours.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $admin_role = Roles::where('role_name', 'admin')->firstOrFail();
        return $user->role_id === $admin_role->id;
    }

    /**
     * Determine whether the user can update the working hours.
     *
     * @param  \App\User  $user
     * @param  \App\WorkingHours  $workingHours
     * @return mixed
     */
    public function update(User $user, WorkingHours $workingHours)
    {
        return $user->store_id === $workingHours->store_id;
    }

    /**
     * Determine whether the user can delete the working hours.
     *
     * @param  \App\User  $user
     * @param  \App\WorkingHours  $workingHours
     * @return mixed
     */
    public function delete(User $user, WorkingHours $workingHours)
    {
        $admin_role = Roles::where('role_name', 'admin')->firstOrFail();
        return $user->role_id === $admin_role->id;
    }

    /**
     * Determine whether the user can restore the working hours.
     *
     * @param  \App\User  $user
     * @param  \App\WorkingHours  $workingHours
     * @return mixed
     */
    public function restore(User $user, WorkingHours $workingHours)
    {
        $admin_role = Roles::where('role_name', 'admin')->firstOrFail();
        return $user->role_id === $admin_role->id;
    }

    /**
     * Determine whether the user can permanently delete the working hours.
     *
     * @param  \App\User  $user
     * @param  \App\WorkingHours  $workingHours
     * @return mixed
     */
    public function forceDelete(User $user, WorkingHours $workingHours)
    {
        $admin_role = Roles::where('role_name', 'admin')->firstOrFail();
        return $user->role_id === $admin_role->id;
    }
}
