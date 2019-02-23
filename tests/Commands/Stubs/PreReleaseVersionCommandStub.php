<?php

namespace Spinen\Version\Commands\Stubs;

use Spinen\Version\Commands\PreReleaseVersionCommand;

/**
 * Class PreReleaseVersionCommandStub
 *
 * Wrapper over the class to allow setting some properties for testing.
 *
 * @package Spinen\Version\Commands\Stubs
 */
class PreReleaseVersionCommandStub extends PreReleaseVersionCommand
{
    use InteractionLoopback;
}
