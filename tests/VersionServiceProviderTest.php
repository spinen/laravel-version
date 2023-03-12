<?php

namespace Spinen\Version;

use ArrayAccess as Application;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\Routing\Registrar as Router;
use Illuminate\Contracts\View\Factory as View;
use Illuminate\Support\ServiceProvider;
use Mockery;

class VersionServiceProviderTest extends TestCase
{
    /**
     * @var Mockery\Mock
     */
    protected $application_mock;

    /**
     * @var Mockery\Mock
     */
    protected $config_mock;

    /**
     * @var Mockery\Mock
     */
    protected $router_mock;

    /**
     * @var ServiceProvider
     */
    protected $service_provider;

    /**
     * @var Mockery\Mock
     */
    protected $view_mock;

    public function setup(): void
    {
        parent::setUp();

        $this->setUpMocks();

        $this->service_provider = new VersionServiceProvider($this->application_mock);
    }

    private function setUpMocks()
    {
        $this->application_mock = Mockery::mock(Application::class);

        $this->config_mock = Mockery::mock(Config::class);

        $this->router_mock = Mockery::mock(Router::class);

        $this->view_mock = Mockery::mock(View::class);

        $this->application_mock->shouldReceive('runningInConsole')
                               ->andReturn(true);

        $this->application_mock->shouldReceive('offsetGet')
                               ->with('config')
                               ->andReturn($this->config_mock);

        $this->application_mock->shouldReceive('offsetGet')
                               ->with('router')
                               ->andReturn($this->router_mock);

        $this->application_mock->shouldReceive('offsetGet')
                               ->with('view')
                               ->andReturn($this->view_mock);
    }

    /**
     * @test
     *
     * @group unit
     */
    public function it_can_be_constructed()
    {
        $this->assertInstanceOf(VersionServiceProvider::class, $this->service_provider);
    }

    /**
     * @test
     *
     * @group unit
     */
    public function it_boots_the_service()
    {
        $this->config_mock->shouldReceive('get')
                          ->once()
                          ->withArgs(
                              [
                                  'version.route.enabled',
                              ]
                          )
                          ->andReturnFalse();

        $this->config_mock->shouldReceive('get')
                          ->once()
                          ->withArgs(
                              [
                                  'version.view.enabled',
                              ]
                          )
                          ->andReturnFalse();

        $this->assertNull($this->service_provider->boot());
    }

    /**
     * @test
     *
     * @group unit
     */
    public function it_registers_the_service()
    {
        $this->application_mock->shouldReceive('singleton')
                               ->once()
                               ->withAnyArgs()
                               ->andReturnNull();

        $this->assertNull($this->service_provider->register());

        // NOTE: It would be nice to verify that the config got set.
    }

    /**
     * @test
     */
    public function it_allows_disabling_the_version_route()
    {
        $this->config_mock->shouldReceive('get')
                          ->once()
                          ->withArgs(
                              [
                                  'version.route.enabled',
                              ]
                          )
                          ->andReturnFalse();

        $this->config_mock->shouldReceive('get')
                          ->never()
                          ->withAnyArgs();

        $this->router_mock->shouldReceive('group')
                          ->never()
                          ->withAnyArgs();

        $this->config_mock->shouldReceive('get')
                          ->once()
                          ->withArgs(
                              [
                                  'version.view.enabled',
                              ]
                          )
                          ->andReturnFalse();

        $this->service_provider->boot();
    }

    /**
     * @test
     */
    public function it_allows_setting_middleware()
    {
        $this->config_mock->shouldReceive('get')
                          ->once()
                          ->withArgs(
                              [
                                  'version.route.enabled',
                              ]
                          )
                          ->andReturnTrue();

        $this->config_mock->shouldReceive('get')
                          ->once()
                          ->withArgs(
                              [
                                  'version.route.middleware',
                                  'web',
                              ]
                          )
                          ->andReturn('middleware');

        $this->router_mock->shouldReceive('group')
                          ->once()
                          ->withArgs(
                              [
                                  [
                                      'namespace' => 'Spinen\Version\Http\Controllers',
                                      'middleware' => 'middleware',
                                  ],
                                  Mockery::any(),
                              ]
                          )
                          ->andReturnNull();

        $this->config_mock->shouldReceive('get')
                          ->once()
                          ->withArgs(
                              [
                                  'version.view.enabled',
                              ]
                          )
                          ->andReturnFalse();

        $this->service_provider->boot();
    }

    /**
     * @test
     */
    public function it_loads_expected_routes()
    {
        $this->config_mock->shouldReceive('get')
                          ->once()
                          ->withArgs(
                              [
                                  'version.route.enabled',
                              ]
                          )
                          ->andReturnTrue();

        $this->config_mock->shouldReceive('get')
                          ->once()
                          ->withArgs(
                              [
                                  'version.route.middleware',
                                  'web',
                              ]
                          )
                          ->andReturn('middleware');

        $this->config_mock->shouldReceive('get')
                          ->once()
                          ->withArgs(
                              [
                                  'version.route.uri',
                                  'version',
                              ]
                          )
                          ->andReturn('uri');

        $this->config_mock->shouldReceive('get')
                          ->once()
                          ->withArgs(
                              [
                                  'version.route.name',
                                  'version',
                              ]
                          )
                          ->andReturn('name');

        $this->router_mock->shouldReceive('group')
                          ->once()
                          ->withArgs(
                              [
                                  Mockery::any(),
                                  Mockery::on(function ($closure) {
                                      return is_null($closure($this->router_mock));
                                  }),
                              ]
                          )
                          ->andReturnNull();

        $this->router_mock->shouldReceive('get')
                          ->once()
                          ->withArgs(
                              [
                                  'uri',
                                  'VersionController@version',
                              ]
                          )
                          ->andReturnSelf();

        $this->router_mock->shouldReceive('name')
                          ->once()
                          ->withArgs(
                              [
                                  'name',
                              ]
                          )
                          ->andReturnSelf();

        $this->config_mock->shouldReceive('get')
                          ->once()
                          ->withArgs(
                              [
                                  'version.view.enabled',
                              ]
                          )
                          ->andReturnFalse();

        $this->service_provider->boot();
    }

    /**
     * @test
     */
    public function it_allows_disabling_the_view_composer()
    {
        $this->config_mock->shouldReceive('get')
                          ->once()
                          ->withArgs(
                              [
                                  'version.route.enabled',
                              ]
                          )
                          ->andReturnFalse();

        $this->config_mock->shouldReceive('get')
                          ->once()
                          ->withArgs(
                              [
                                  'version.view.enabled',
                              ]
                          )
                          ->andReturnFalse();

        $this->config_mock->shouldReceive('get')
                          ->never()
                          ->withAnyArgs();

        $this->view_mock->shouldReceive('composer')
                        ->never()
                        ->withAnyArgs();

        $this->service_provider->boot();
    }

    /**
     * @test
     */
    public function it_allows_setting_the_views_to_attach()
    {
        $this->config_mock->shouldReceive('get')
                          ->once()
                          ->withArgs(
                              [
                                  'version.route.enabled',
                              ]
                          )
                          ->andReturnFalse();

        $this->config_mock->shouldReceive('get')
                          ->once()
                          ->withArgs(
                              [
                                  'version.view.enabled',
                              ]
                          )
                          ->andReturnTrue();

        $this->config_mock->shouldReceive('get')
                          ->once()
                          ->withArgs(
                              [
                                  'version.view.views',
                                  '*',
                              ]
                          )
                          ->andReturn('some.views');

        $this->view_mock->shouldReceive('composer')
                        ->once()
                        ->withArgs(
                            [
                                'some.views',
                                Mockery::any(),
                            ]
                        );

        $this->service_provider->boot();
    }

    /**
     * @test
     */
    public function it_allows_setting_the_variable_to_attach_the_version_instance()
    {
        $this->config_mock->shouldReceive('get')
                          ->once()
                          ->withArgs(
                              [
                                  'version.route.enabled',
                              ]
                          )
                          ->andReturnFalse();

        $this->config_mock->shouldReceive('get')
                          ->once()
                          ->withArgs(
                              [
                                  'version.view.enabled',
                              ]
                          )
                          ->andReturnTrue();

        $this->config_mock->shouldReceive('get')
                          ->once()
                          ->withArgs(
                              [
                                  'version.view.views',
                                  '*',
                              ]
                          )
                          ->andReturn('some.views');

        $this->view_mock->shouldReceive('composer')
                        ->once()
                        ->withArgs(
                            [
                                Mockery::any(),
                                Mockery::on(function ($closure) {
                                    $this->config_mock->shouldReceive('get')
                                                      ->once()
                                                      ->withArgs(
                                                          [
                                                              'version.view.variable',
                                                              'version',
                                                          ]
                                                      )
                                                      ->andReturn('variable');

                                    $this->application_mock->shouldReceive('make')
                                                           ->once()
                                                           ->withArgs(
                                                               [
                                                                   Version::class,
                                                               ]
                                                           )
                                                           ->andReturn('version instance');

                                    $view_mock = Mockery::mock();

                                    $view_mock->shouldReceive('with')
                                              ->once()
                                              ->withArgs(
                                                  [
                                                      'variable',
                                                      'version instance',
                                                  ]
                                              )
                                              ->andReturnTrue();

                                    return $closure($view_mock);
                                }),
                            ]
                        );

        $this->service_provider->boot();
    }

    /**
     * @test
     */
    public function it_allows_setting_the_version_file()
    {
        $this->application_mock->shouldReceive('singleton')
                               ->once()
                               ->withArgs(
                                   [
                                       Version::class,
                                       Mockery::on(function ($closure) {
                                           $this->config_mock->shouldReceive('get')
                                                             ->once()
                                                             ->withArgs(
                                                                 [
                                                                     'version.file',
                                                                     'VERSION',
                                                                 ]
                                                             )
                                                             ->andReturn('file');

                                           $this->assertInstanceOf(Version::class, $closure());

                                           return true;
                                       }),
                                   ]
                               )
                               ->andReturnNull();

        $this->assertNull($this->service_provider->register());
    }
}

function config_path($file)
{
    return 'path/to/config/'.$file;
}
