<?php

namespace LoLong\NhanVien;

use Illuminate\Support\ServiceProvider;

class NhanVienServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'lolong');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'lolong');
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
        $this->mergeConfigFrom(__DIR__.'/../config/nhanvien.php', 'nhanvien');

        // Register the service the package provides.
        $this->app->singleton('nhanvien', function ($app) {
            return new NhanVien;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['nhanvien'];
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
            __DIR__.'/../config/nhanvien.php' => config_path('nhanvien.php'),
        ], 'nhanvien.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/lolong'),
        ], 'nhanvien.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/lolong'),
        ], 'nhanvien.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/lolong'),
        ], 'nhanvien.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
