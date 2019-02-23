<?php

namespace Spinen\Version\Commands\Stubs;

use Spinen\Version\Commands\MinorVersionCommand;

/**
 * Class MinorVersionCommandStub
 *
 * Wrapper over the class to allow setting some properties for testing.
 *
 * @package Spinen\Version\Commands\Stubs
 */
class MinorVersionCommandStub extends MinorVersionCommand
{
    use InteractionLoopback;
}
