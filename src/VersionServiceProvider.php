<?php

namespace Spinen\Version;

use Illuminate\Contracts\Routing\Registrar as Router;
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
        if ($this->app['config']->get('version.route.enabled')) {
            $this->app['router']->group(
                [
                    'namespace' => 'Spinen\Version\Http\Controllers',
                    'middleware' => $this->app['config']->get('version.route.middleware', 'web'),
                ],
                function (Router $router) {
                    $router->get($this->app['config']->get('version.route.uri', 'version'), 'VersionController@version')
                           ->name($this->app['config']->get('version.route.name', 'version'));
                }
            );
        }

        if ($this->app['config']->get('version.view.enabled')) {
            $this->app['view']->composer(
                $this->app['config']->get('version.view.views', '*'),
                function ($view) {
                    return $view->with(
                        $this->app['config']->get('version.view.variable', 'version'),
                        $this->app->make(Version::class)
                    );
                }
            );
        }

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
        $this->app->singleton(
            Version::class,
            function () {
                return new Version(base_path($this->app['config']->get('version.file', 'VERSION')));
            }
        );

        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    realpath(__DIR__.'/../config/version.php') => config_path('version.php'),
                ],
                'version-config'
            );
        }
    }
}
