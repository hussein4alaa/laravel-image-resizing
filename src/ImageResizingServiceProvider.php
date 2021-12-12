<?php

namespace g4t\ImageResizing;

use Illuminate\Support\ServiceProvider;

class ImageResizingServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/ImageResizing.php', 'ImageResizing');

        // Register the service the package provides.
        $this->app->singleton('ImageResizing', function ($app) {
            return new Upload;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['ImageResizing'];
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
            __DIR__.'/../config/ImageResizing.php' => config_path('ImageResizing.php'),
        ], 'ImageResizing.config');


    }
}
