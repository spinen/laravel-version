<?php

namespace Spinen\Version;

class HelpersTest extends TestCase
{
    /**
     * @test
     */
    public function it_has_a_helper()
    {
        $this->assertInstanceOf(Version::class, app_version());
    }
}
