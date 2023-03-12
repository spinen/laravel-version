<?php

namespace Spinen\Version\Commands\Stubs;

use Spinen\Version\Commands\MajorVersionCommand;

/**
 * Class MajorVersionCommandStub
 *
 * Wrapper over the class to allow setting some properties for testing.
 */
class MajorVersionCommandStub extends MajorVersionCommand
{
    use InteractionLoopback;
}
