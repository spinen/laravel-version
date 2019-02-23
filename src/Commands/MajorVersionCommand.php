<?php

namespace Spinen\Version\Commands;

/**
 * Class MajorVersionCommand
 *
 * @package Spinen\Version\Commands
 */
class MajorVersionCommand extends VersionCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'version:major';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display major version of the application.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info($this->version->major);
    }
}
