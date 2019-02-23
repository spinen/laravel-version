<?php

namespace Spinen\Version\Commands\Stubs;

use Spinen\Version\Commands\PatchVersionCommand;

/**
 * Class PatchVersionCommandStub
 *
 * Wrapper over the class to allow setting some properties for testing.
 *
 * @package Spinen\Version\Commands\Stubs
 */
class PatchVersionCommandStub extends PatchVersionCommand
{
    use InteractionLoopback;
}
