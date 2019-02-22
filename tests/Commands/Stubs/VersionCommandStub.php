<?php

namespace Spinen\Version\Commands\Stubs;

use Spinen\Version\Commands\VersionCommand;

/**
 * Class VersionCommandStub
 *
 * Wrapper over the class to allow setting some properties for testing.
 *
 * @package Spinen\Version\Commands\Stubs
 */
class VersionCommandStub extends VersionCommand
{
    /**
     * Set the input.
     *
     * @param $input
     *
     * @return $this
     */
    public function setInput($input)
    {
        $this->input = $input;

        return $this;
    }

    /**
     * Set the output.
     *
     * @param $output
     *
     * @return $this
     */
    public function setOutput($output)
    {
        $this->output = $output;

        return $this;
    }
}
