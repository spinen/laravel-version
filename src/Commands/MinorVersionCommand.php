<?php

namespace Spinen\Version\Commands;

/**
 * Class MinorVersionCommand
 *
 * @package Spinen\Version\Commands
 */
class MinorVersionCommand extends VersionCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'version:minor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display minor version of the application.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info($this->version->minor);
    }
}
