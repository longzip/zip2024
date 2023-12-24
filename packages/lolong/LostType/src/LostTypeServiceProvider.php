<?php

namespace Lolong\LostType;

use Illuminate\Support\ServiceProvider;

class LostTypeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/LostType.php', 'lost-type');
        $this->publishThings();
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'LostType');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register facade
        $this->app->singleton('lost-type', function () {
            return new LostType;
        });
    }

    public function publicThings(){
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/LostType.php' => config_path('LostType.php'),
            ], 'config');
        }
    }
}