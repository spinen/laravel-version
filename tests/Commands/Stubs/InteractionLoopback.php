<?php

namespace Spinen\Version\Commands\Stubs;

/**
 * Trait InteractionLoopback
 *
 * @package Spinen\Version\Commands\Stubs
 */
trait InteractionLoopback
{
    /**
     * @var mixed
     */
    protected $input;

    /**
     * @var mixed
     */
    protected $output;

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
