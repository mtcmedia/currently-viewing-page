<?php

namespace Mtc\CurrentlyViewing\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Mtc\CurrentlyViewing\ViewerManager;

/**
 * Class BasketServiceProvider
 * @package Mtc\Basket\Providers
 */
class CurrentlyViewingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadTranslationsFrom(dirname(__DIR__, 2) . '/resources/lang', 'basket');
        $this->loadMigrationsFrom(dirname(__DIR__, 2) . '/database/migrations');
        Route::middleware(['web', 'auth'])->group(dirname(__DIR__, 2) . '/routes/web.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                dirname(__DIR__, 2) . '/config/currently_viewing.php' => config_path('currently_viewing.php'),
            ], 'config');

            // Publishing assets.
            $this->publishes([
                dirname(__DIR__, 2) . '/resources/js' => resource_path('js'),
            ], 'assets');
        }

    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(dirname(__DIR__, 2) . '/config/currently_viewing.php', 'currently_viewing');

        $this->app->singleton('currently_viewing', function () {
            return new ViewerManager;
        });

    }

}
