<?php

namespace Spinen\Version\Commands;

/**
 * Class SemVersionCommand
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
     */
    public function handle(): void
    {
        $this->info($this->version->semver);
    }
}
