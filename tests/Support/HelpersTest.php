<?php

namespace Spinen\Version;

use Illuminate\Support\Facades\Config;

class HelpersTest extends TestCase
{
    /**
     * @test
     */
    public function it_has_a_helper()
    {
        Config::shouldReceive('get')
              ->once()
              ->withAnyArgs()
              ->andReturn('file');

        $this->assertInstanceOf(Version::class, app_version());
    }
}
