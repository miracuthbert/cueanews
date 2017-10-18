<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     * Determine whether the user can view the admin.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        $role = $user->roles->count();

        $role = $role > 0 ? true : false;

        return $role;
    }

}
