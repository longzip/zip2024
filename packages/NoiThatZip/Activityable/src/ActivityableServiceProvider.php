<?php

namespace NoiThatZip\Activityable;

use Illuminate\Support\ServiceProvider;

class ActivityableServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'noithatzip');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'noithatzip');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/activityable.php', 'activityable');

        // Register the service the package provides.
        $this->app->singleton('activityable', function ($app) {
            return new Activityable;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['activityable'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/activityable.php' => config_path('activityable.php'),
        ], 'activityable.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/noithatzip'),
        ], 'activityable.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/noithatzip'),
        ], 'activityable.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/noithatzip'),
        ], 'activityable.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
