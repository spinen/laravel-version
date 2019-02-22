<?php

namespace Spinen\Version\Commands\Stubs;

use Spinen\Version\Commands\MajorVersionCommand;

/**
 * Class MajorVersionCommandStub
 *
 * Wrapper over the class to allow setting some properties for testing.
 *
 * @package Spinen\Version\Commands\Stubs
 */
class MajorVersionCommandStub extends MajorVersionCommand
{
    use InteractionLoopback;
}
