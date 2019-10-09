<?php

namespace Silvanite\NovaToolPermissions\Traits;

use Silvanite\Brandenburg\Role as RoleModel;

trait IsProtectableModel
{
    public function initializeIsProtectableModel()
    {
        $this->with = array_merge($this->with, [
            'rolesWithAccess',
        ]);
    }

    public function rolesWithAccess()
    {
        return $this->morphToMany(RoleModel::class, 'protectable');
    }
}