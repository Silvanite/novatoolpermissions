<?php

namespace Silvanite\NovaToolPermissions\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishConfigs();
        $this->loadTranslations();
        $this->loadMigrations();
        $this->registerGates();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            $this->getConfigsPath(),
            'novatoolpermissions'
        );
    }

    /**
     * Publish configuration file.
	 *
     * @return void
     */
    private function publishConfigs() {
        $this->publishes([
            $this->getConfigsPath() => config_path('novatoolpermissions.php'),
        ], 'config');
    }

    private function loadTranslations()
    {
        $this->loadJSONTranslationsFrom(__DIR__.'/../Resources/lang', 'novatoolpermissions');
    }

    private function loadMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');

        $this->publishes([
            __DIR__ . '/../Database/migrations' => base_path('database/migrations')
        ], 'migrations');
    }

    private function registerGates()
    {
        Gate::define('accessContent', function ($user, $access = null) {
            if ($access === null) {
                return true;
            }

            if (!count($access->roles)) {
                return true;
            }
            return $user->roles->pluck('id')->intersect($access->roles)->count();
        });
    }

    /**
     * Get local package configuration path.
     *
     * @return string
     */
    private function getConfigsPath()
    {
        return __DIR__.'/../Configs/novatoolpermissions.php';
    }
}
