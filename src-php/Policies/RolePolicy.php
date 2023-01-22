<?php

namespace Silvanite\NovaToolPermissions\Policies;

use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
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
        return Gate::any(['viewRoles', 'manageRoles'], $user);
    }

    public function view($user)
    {
        return Gate::any(['viewRoles', 'manageRoles'], $user);
    }

    public function create($user)
    {
        return $user->can('manageRoles');
    }

    public function update($user)
    {
        return $user->can('manageRoles');
    }

    public function delete($user)
    {
        return $user->can('manageRoles');
    }

    public function restore($user)
    {
        return $user->can('manageRoles');
    }

    public function forceDelete($user)
    {
        return $user->can('manageRoles');
    }

    public function attachAnyUser($user, $model)
    {
        return Gate::any(['assignRoles', 'manageRoles'], $user);
    }
    
    public function detachAnyUser($user, $model)
    {
        return $user->can('manageRoles');
    }
}
