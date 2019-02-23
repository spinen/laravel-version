<?php

namespace Spinen\Version\Commands;

/**
 * Class PatchVersionCommand
 *
 * @package Spinen\Version\Commands
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
     *
     * @return void
     */
    public function handle()
    {
        $this->info($this->version->patch);
    }
}
