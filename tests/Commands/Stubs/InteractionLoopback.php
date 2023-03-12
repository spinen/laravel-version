<?php

namespace Spinen\Version\Commands\Stubs;

/**
 * Trait InteractionLoopback
 */
trait InteractionLoopback
{
    protected $input;

    protected $output;

    /**
     * Set the input.
     *
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
     *
     * @return $this
     */
    public function setOutput($output)
    {
        $this->output = $output;

        return $this;
    }
}
