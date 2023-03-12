<?php

namespace Spinen\Version\Commands;

/**
 * Class PatchVersionCommand
 */
class PatchVersionCommand extends VersionCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'version:patch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display patch version of the application.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info($this->version->patch);
    }
}
