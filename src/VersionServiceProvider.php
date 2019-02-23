<?php

namespace Spinen\Version;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Spinen\Version\Commands\MajorVersionCommand;
use Spinen\Version\Commands\MetaVersionCommand;
use Spinen\Version\Commands\MinorVersionCommand;
use Spinen\Version\Commands\PatchVersionCommand;
use Spinen\Version\Commands\PreReleaseVersionCommand;
use Spinen\Version\Commands\SemVersionCommand;
use Spinen\Version\Commands\VersionCommand;

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
        Route::group(
            [
                // TODO: Pull these values from config
                //'prefix'     => 'horizon',
                'namespace'  => 'Spinen\Version\Http\Controllers',
                //'middleware' => config('version.route.middleware', 'web'),
            ],
            function () {
                $this->loadRoutesFrom(realpath(__DIR__ . '/routes/web.php'));
            }
        );

        if ($this->app->runningInConsole()) {
            $this->commands(
                [
                    MajorVersionCommand::class,
                    MetaVersionCommand::class,
                    MinorVersionCommand::class,
                    PatchVersionCommand::class,
                    PreReleaseVersionCommand::class,
                    SemVersionCommand::class,
                    VersionCommand::class,
                ]
            );
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    realpath(__DIR__ . '/config/version.php') => config_path('version.php'),
                ],
                'version-config'
            );
        }
    }
}
