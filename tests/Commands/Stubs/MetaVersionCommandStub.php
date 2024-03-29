<?php

namespace Spinen\Version\Commands\Stubs;

use Spinen\Version\Commands\MetaVersionCommand;

/**
 * Class MetaVersionCommandStub
 *
 * Wrapper over the class to allow setting some properties for testing.
 */
class MetaVersionCommandStub extends MetaVersionCommand
{
    use InteractionLoopback;
}
