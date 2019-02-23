<?php

namespace Spinen\Version\Commands\Stubs;

use Spinen\Version\Commands\SemVersionCommand;

/**
 * Class SemVersionCommandStub
 *
 * Wrapper over the class to allow setting some properties for testing.
 *
 * @package Spinen\Version\Commands\Stubs
 */
class SemVersionCommandStub extends SemVersionCommand
{
    use InteractionLoopback;
}
