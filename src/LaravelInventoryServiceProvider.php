<?php

namespace Laravel\Sanctum;

use Illuminate\Auth\RequestGuard;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Console\Commands\PruneExpired;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
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

            $this->commands([
                PruneExpired::class,
            ]);
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
