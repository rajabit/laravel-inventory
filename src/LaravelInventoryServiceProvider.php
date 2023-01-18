<?php

namespace Rajabit\LaravelInventory;


use Illuminate\Support\ServiceProvider;
use Rajabit\LaravelInventory\LaravelInventory;

class LaravelInventoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (! app()->configurationIsCached()) {
            $this->mergeConfigFrom(__DIR__.'/../config/inventory.php', 'inventory');
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (app()->runningInConsole()) {
            $this->registerMigrations();

            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], 'inventory-migrations');

            $this->publishes([
                __DIR__.'/../config/inventory.php' => config_path('inventory.php'),
            ], 'inventory-config');
        }
    }

    /**
     * Register inventory'ies migration files.
     *
     * @return void
     */
    protected function registerMigrations()
    {
        if (LaravelInventory::shouldRunMigrations()) {
            return $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        }
    }
}
