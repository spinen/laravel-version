<?php

namespace Spinen\Version\Http\Controllers;

use Illuminate\Contracts\Config\Repository as Config;
use Mockery;
use Spinen\Version\TestCase;
use Spinen\Version\Version;

/**
 * Class VersionControllerTest
 *
 * @package Spinen\Version\Http\Controllers
 */
class VersionControllerTest extends TestCase
{
    /**
     * @var Mockery\Mock
     */
    protected $config_mock;

    /**
     * The VersionController instance
     *
     * @var VersionController
     */
    protected $controller;

    /**
     * @var Mockery\Mock
     */
    protected $version_mock;

    public function setUp(): void
    {
        parent::setUp();

        $this->controller = new VersionController();

        $this->config_mock = Mockery::mock(Config::class);

        $this->version_mock = Mockery::mock(Version::class);
    }

    /**
     * @test
     */
    public function it_can_be_constructed()
    {
        $this->assertInstanceOf(VersionController::class, $this->controller);
    }

    /**
     * @test
     */
    public function it_returns_version()
    {
        $this->config_mock->shouldReceive('get')
                          ->once()
                          ->withAnyArgs()
                          ->andReturn('expose');

        $this->version_mock->expose = 'version';

        $this->assertEquals('version Hostname: ' . gethostname(), $this->controller->version($this->config_mock, $this->version_mock));
    }
}
