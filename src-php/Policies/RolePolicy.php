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

    public function view($user, $model)
    {
        return Gate::any(['viewRoles', 'manageRoles'], $user);
    }

    public function create($user)
    {
        return $user->can('manageRoles');
    }

    public function update($user, $model)
    {
        return $user->can('manageRoles');
    }

    public function delete($user, $model)
    {
        return $user->can('manageRoles');
    }

    public function restore($user, $model)
    {
        return $user->can('manageRoles');
    }

    public function forceDelete($user, $model)
    {
        return $user->can('manageRoles');
    }

    public function attachAnyUser($user, $model)
    {
        return Gate::any(['assignRoles', 'manageRoles'], $user);
    }
}
