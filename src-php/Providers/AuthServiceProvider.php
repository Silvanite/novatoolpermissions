<?php

namespace Silvanite\NovaToolPermissions\Providers;

use Silvanite\Brandenburg\Role;
use Illuminate\Support\Facades\Gate;
use Silvanite\NovaToolPermissions\Policies\RolePolicy;
use Silvanite\NovaToolPermissions\Policies\UserPolicy;
use Silvanite\Brandenburg\Traits\ValidatesPermissions;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    use ValidatesPermissions;

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Role::class => RolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->policies[config('brandenburg.userModel')] = UserPolicy::class;

        $this->registerPolicies();
        $this->defineGates();
    }

    private function defineGates()
    {
        collect([
            'assignRoles',
            'manageRoles',
            'manageUsers',
            'viewRoles',
            'viewUsers',
            'viewNova',
            'canBeGivenAccess',
        ])->each(function ($permission) {
            Gate::define($permission, function ($user) use ($permission) {
                if ($this->nobodyHasAccess($permission)) {
                    return true;
                }

                return $user->hasRoleWithPermission($permission);
            });
        });
    }
}
