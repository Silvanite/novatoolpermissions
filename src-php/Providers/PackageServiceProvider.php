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
    public function boot()
    {
        $this->publishConfigs();
        $this->loadTranslations();
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
