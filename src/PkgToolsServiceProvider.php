<?php

namespace Pfinalclub\PkgTools;

use Illuminate\Support\ServiceProvider;
use Pfinalclub\PkgTools\Console\PkgCommand;

class PkgToolsServiceProvider extends ServiceProvider
{
    protected $commands = [
        PkgCommand::class,
    ];
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'pfinal-pkg-tools');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'pfinal-pkg-tools');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('pfinal-pkg-tools.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/pfinal-pkg-tools'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/pfinal-pkg-tools'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/pfinal-pkg-tools'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'pfinal-pkg-tools');

        $this->commands($this->commands);

        // Register the main class to use with the facade
        $this->app->singleton('pfinal-pkg-tools', function () {
            return new PkgTools;
        });
    }
}
