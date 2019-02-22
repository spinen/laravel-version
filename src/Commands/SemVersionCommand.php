<?php

namespace Spinen\Version\Commands;

/**
 * Class SemVersionCommand
 *
 * @package Spinen\Version\Commands
 */
class SemVersionCommand extends VersionCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'version:semver';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display semver version of the application.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info($this->version->semver);
    }
}
