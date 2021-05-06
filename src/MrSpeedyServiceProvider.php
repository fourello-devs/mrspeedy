<?php

namespace FourelloDevs\MrSpeedy;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

/**
 * Class MrSpeedyServiceProvider
 * @package FourelloDevs\MrSpeedy
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-07
 */
class MrSpeedyServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'fourello-devs');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'fourello-devs');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

        // Register Helpers
        $this->registerHelpers();
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/mr-speedy.php', 'mr-speedy');

        // Register the service the package provides.
        $this->app->singleton('mr-speedy', function ($app) {
            return new MrSpeedy;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['mr-speedy'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/mr-speedy.php' => config_path('mr-speedy.php'),
        ], 'mr-speedy.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/fourello-devs'),
        ], 'mr-speedy.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/fourello-devs'),
        ], 'mr-speedy.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/fourello-devs'),
        ], 'mr-speedy.views');*/

        // Registering package commands.
        // $this->commands([]);
    }

    /**
     * Register helpers file
     */
    public function registerHelpers(): void
    {
        $path = __DIR__ . '/../helpers/CustomHelpers.php';
        if (! function_exists('mrspeedy') && File::exists($path)) {
            require_once __DIR__ . '/../helpers/CustomHelpers.php';
        }
    }
}
