<?php

namespace Spinen\Version;

use ArrayAccess as Application;
use Illuminate\Contracts\Events\Dispatcher as Events;
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
        $this->assertNull($this->service_provider->boot());

        // NOTE: It would be nice to verify that the config got set.
    }
}

function config_path($file)
{
    return 'path/to/config/' . $file;
}
