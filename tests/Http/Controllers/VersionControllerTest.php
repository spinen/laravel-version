<?php

namespace Spinen\Version\Http\Controllers;

use Illuminate\Support\Facades\Config;
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
        Config::shouldReceive('get')
              ->once()
              ->withAnyArgs()
              ->andReturn('expose');

        $this->version_mock->expose= 'version';

        $this->assertEquals('version', $this->controller->version($this->version_mock));
    }
}
