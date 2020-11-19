<?php

namespace App\Policies;

use App\User;
use App\Roles;
use Illuminate\Auth\Access\HandlesAuthorization;

class ManagerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the manager.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can create managers.
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
     * Determine whether the user can update the manager.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        $admin_role = Roles::where('role_name', 'admin')->firstOrFail();
        return $user->role_id === $admin_role->id;
    }

    /**
     * Determine whether the user can delete the manager.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        $admin_role = Roles::where('role_name', 'admin')->firstOrFail();
        return $user->role_id === $admin_role->id;
    }

    /**
     * Determine whether the user can restore the manager.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function restore(User $user)
    {
        $admin_role = Roles::where('role_name', 'admin')->firstOrFail();
        return $user->role_id === $admin_role->id;
    }

    /**
     * Determine whether the user can permanently delete the manager.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        $admin_role = Roles::where('role_name', 'admin')->firstOrFail();
        return $user->role_id === $admin_role->id;
    }
}
