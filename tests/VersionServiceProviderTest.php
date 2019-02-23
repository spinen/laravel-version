<?php

namespace Spinen\Version;

use ArrayAccess as Application;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Mockery;

class VersionServiceProviderTest extends TestCase
{
    /**
     * @var Mockery\Mock
     */
    protected $application_mock;

    /**
     * @var ServiceProvider
     */
    protected $service_provider;

    public function setup(): void
    {
        parent::setUp();

        $this->setUpMocks();

        $this->service_provider = new VersionServiceProvider($this->application_mock);
    }

    private function setUpMocks()
    {
        $this->application_mock = Mockery::mock(Application::class);
        $this->application_mock->shouldReceive('runningInConsole')
                               ->andReturn(true);
    }

    /**
     * @test
     * @group unit
     */
    public function it_can_be_constructed()
    {
        $this->assertInstanceOf(VersionServiceProvider::class, $this->service_provider);
    }

    /**
     * @test
     * @group unit
     */
    public function it_boots_the_service()
    {
        Config::shouldReceive('get')
              ->once()
              ->withArgs(
                  [
                      'version.route.enabled',
                  ]
              )
              ->andReturnTrue();

        Config::shouldReceive('get')
              ->once()
              ->withArgs(
                  [
                      'version.route.middleware',
                      'web',
                  ]
              )
              ->andReturn('middleware');

        Route::shouldReceive('group')
             ->once()
             ->withArgs(
                 [
                     Mockery::any(),
                     Mockery::any(),
                 ]
             )
             ->andReturnNull();

        $this->assertNull($this->service_provider->boot());
    }

    /**
     * @test
     * @group unit
     */
    public function it_registers_the_service()
    {
        $this->assertNull($this->service_provider->register());

        // NOTE: It would be nice to verify that the config got set.
    }

    /**
     * @test
     */
    public function it_allows_disabling_the_version_route()
    {
        Config::shouldReceive('get')
              ->once()
              ->withArgs(
                  [
                      'version.route.enabled',
                  ]
              )
              ->andReturnFalse();

        Config::shouldReceive('get')
              ->never()
              ->withAnyArgs();

        Route::shouldReceive('group')
             ->never()
             ->withAnyArgs();

        $this->service_provider->boot();
    }

    /**
     * @test
     */
    public function it_allows_setting_middleware()
    {
        Config::shouldReceive('get')
              ->once()
              ->withArgs(
                  [
                      'version.route.enabled',
                  ]
              )
              ->andReturnTrue();

        Config::shouldReceive('get')
              ->once()
              ->withArgs(
                  [
                      'version.route.middleware',
                      'web',
                  ]
              )
              ->andReturn('middleware');

        Route::shouldReceive('group')
             ->once()
             ->withArgs(
                 [
                     [
                         'namespace'  => 'Spinen\Version\Http\Controllers',
                         'middleware' => 'middleware',
                     ],
                     Mockery::any(),
                 ]
             )
             ->andReturnNull();

        $this->service_provider->boot();
    }

    /**
     * @test
     */
    public function it_loads_expected_route_file()
    {
        Config::shouldReceive('get')
              ->once()
              ->withArgs(
                  [
                      'version.route.enabled',
                  ]
              )
              ->andReturnTrue();

        Config::shouldReceive('get')
              ->once()
              ->withArgs(
                  [
                      Mockery::any(),
                      Mockery::any(),
                  ]
              )
              ->andReturn('middleware');

        Route::shouldReceive('group')
             ->once()
             ->withArgs(
                 [
                     Mockery::any(),
                     Mockery::on(function ($closure) {
                         $this->application_mock->shouldReceive('routesAreCached')
                                                ->once()
                                                ->withAnyArgs()
                                                ->andReturnTrue();

                         return is_null($closure());
                     }),
                 ]
             )
             ->andReturnNull();

        $this->service_provider->boot();
    }
}

function config_path($file)
{
    return 'path/to/config/' . $file;
}
