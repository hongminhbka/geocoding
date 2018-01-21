<?php

namespace geocoding\Providers;
/**
 * Created by PhpStorm.
 * User: hongm
 * Date: 1/21/2018
 * Time: 10:44 AM
 */

use Illuminate\Support\ServiceProvider;

class GeocodeProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    /**
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../../resources/config/geocode.php' => config_path('geocode.php')
        ]);

        $this->mergeConfigFrom(__DIR__ . '/../../../resources/config/geocode.php', 'geocode');
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register('geocode\Providers\EventServiceProvider');
    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}