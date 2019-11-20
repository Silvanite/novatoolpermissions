<?php

namespace Silvanite\NovaToolPermissions\Providers;

use AccessControlGate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::define('accessControl', function ($user = null, $model) {
            $this->accessContent($user, $model);
        });
    }
}