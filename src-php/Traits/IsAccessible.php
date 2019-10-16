<?php

namespace Silvanite\NovaToolPermissions\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Input;
use Silvanite\NovaToolPermissions\Access;

trait IsAccessible
{
    public function initializeIsAccessible()
    {
        $this->with = array_merge($this->with, [
            'access',
        ]);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $model->access()
                ->create(['roles' => Arr::wrap(Input::get('access_roles', []))]);
        });

        static::deleting(function ($model) {
            if ($model->access) {
                $access = $model->access;
                $access->delete();
            }
        });
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
        if ($access = $this->access) {
            $access->roles = $roles;
            return $access->save();
        }
    }
}
