<?php

namespace Silvanite\NovaToolPermissions\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Silvanite\NovaToolPermissions\Traits\AccessControlGate;

class AccessControlServiceProvider extends ServiceProvider
{
    use AccessControlGate;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('accessControl', function ($user = null, $model = null) {
            $this->accessContent($user, $model);
        });
    }
}
