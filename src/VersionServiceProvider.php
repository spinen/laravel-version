<?php

namespace Spinen\Version;

use Illuminate\Support\ServiceProvider;

/**
 * Class VersionServiceProvider
 *
 * @package Spinen\Version
 */
class VersionServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes(
            [
                realpath(__DIR__ . '/config/version.php') => config_path('version.php'),
            ],
            'config'
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // TODO: Register package here
    }
}
