<?php

namespace Silvanite\NovaToolPermissions\Policies;

use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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

    public function viewAny($user)
    {
        return Gate::any(['viewUsers', 'manageUsers'], $user);
    }

    public function view($user)
    {
        return Gate::any(['viewUsers', 'manageUsers'], $user);
    }

    public function create($user)
    {
        return $user->can('manageUsers');
    }

    public function update($user)
    {
        return $user->can('manageUsers');
    }

    public function delete($user)
    {
        return $user->can('manageUsers');
    }

    public function restore($user)
    {
        return $user->can('manageUsers');
    }

    public function forceDelete($user)
    {
        return $user->can('manageUsers');
    }

    public function attachAnyRole($user, $model)
    {
        return Gate::any(['assignRoles', 'manageRoles'], $user);
    }
}
