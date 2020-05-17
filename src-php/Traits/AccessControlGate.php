<?php

namespace Silvanite\NovaToolPermissions\Traits;

trait AccessControlGate
{
    public function accessContent($user = null, $model = null)
    {
        if ($model->access === null) {
            return true;
        }

        if (!count($model->access->roles)) {
            return true;
        }

        if ($user === null) {
            return false;
        }

        return $user->roles->pluck('id')->intersect($model->access->roles)->count();
    }
}
