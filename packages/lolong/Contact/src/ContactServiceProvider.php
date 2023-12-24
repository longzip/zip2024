<?php

namespace Lolong\Contact;

use Illuminate\Support\ServiceProvider;

class ContactServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/Contact.php', 'contact');
        $this->publishThings();
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'Contact');
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
        $this->app->singleton('contact', function () {
            return new Contact;
        });
    }

    public function publicThings(){
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/Contact.php' => config_path('Contact.php'),
            ], 'config');
        }
    }
}