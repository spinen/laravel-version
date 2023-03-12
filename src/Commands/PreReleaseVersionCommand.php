<?php

namespace Spinen\Version\Commands;

/**
 * Class PreReleaseVersionCommand
 */
class PreReleaseVersionCommand extends VersionCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'version:pre_release';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display pre_release version of the application.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info($this->version->pre_release);
    }
}
