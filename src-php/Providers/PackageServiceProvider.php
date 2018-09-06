<?php

namespace Silvanite\NovaToolPermissions\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->bootCommands();
        $this->loadTranslations();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register the artisan packages' terminal commands
     *
     * @return void
     */
    private function bootCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                // MyCommand::class,
            ]);
        }
    }

    private function loadTranslations()
    {
        $this->loadJSONTranslationsFrom(__DIR__.'/../Resources/lang', 'novatoolpermissions');
    }
}
