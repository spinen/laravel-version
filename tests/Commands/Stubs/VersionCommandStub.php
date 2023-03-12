<?php

namespace Spinen\Version\Commands\Stubs;

use Spinen\Version\Commands\VersionCommand;

/**
 * Class VersionCommandStub
 *
 * Wrapper over the class to allow setting some properties for testing.
 */
class VersionCommandStub extends VersionCommand
{
    use InteractionLoopback;
}
