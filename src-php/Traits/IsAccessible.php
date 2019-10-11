<?php

namespace Silvanite\NovaToolPermissions\Traits;

use Silvanite\NovaToolPermissions\Access;

trait IsAccessible
{
    public function initializeIsAccessible()
    {
        $this->with = array_merge($this->with, [
            'access',
        ]);
    }

    public function access()
    {
        return $this->morphOne(Access::class, 'accessible');
    }

    public function getAccessRolesAttribute()
    {
        return $this->access->roles ?? [];
    }

    public function setAccessRolesAttribute($roles)
    {
        if ($this->access) {
            return $this->access()->update(['roles' => $roles]);
        }

        return $this->access()->create(['roles' => $roles]);
    }
}