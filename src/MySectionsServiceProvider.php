<?php

namespace JoliMardi\MySections;

use Illuminate\Support\ServiceProvider;

class MySectionsServiceProvider extends ServiceProvider {
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        // Publish Nova Resources
        $this->publishes([
            __DIR__ . '/Nova' => app_path('Nova'),
        ], 'nova-resources');

        // Publish views
        $this->publishes([
            __DIR__ . '/views' => resource_path('views/sections'),
        ], 'views');

        // Publish migrations
        $this->publishes([
            __DIR__ . '/migrations' => database_path('migrations'),
        ], 'migrations');

        // Publish CSS
        $this->publishes([
            __DIR__ . '/css' => public_path('css/mysections'),
        ], 'public');

        // Publish Models
        $this->publishes([
            __DIR__ . '/Models' => app_path('Models'),
        ], 'models');

        // Load migrations if not published
        $this->loadMigrationsFrom(__DIR__ . '/migrations');

        // Load views if not published
        $this->loadViewsFrom(__DIR__ . '/views', 'mysections');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
    }
}
