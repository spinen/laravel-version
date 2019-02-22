<?php

namespace Spinen\Version;

class HelpersTest extends TestCase
{
    /**
     * @test
     */
    public function it_has_a_helper()
    {
        $this->assertEquals("1.2.0-branch+meta.data", (string)app_version());
    }
}
