<?php

namespace App\Policies;

use App\User;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view the admin.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        $roles = $user->roles()->whereNull('expires_at')->count();

        $isAllowed = $roles > 0 ? true : false;

        return $isAllowed;
    }

    /**
     * Determine whether the user can create admins.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the admin.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function update(User $user, Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can delete the admin.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function delete(User $user, Admin $admin)
    {
        //
    }
}
