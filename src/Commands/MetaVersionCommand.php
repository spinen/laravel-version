<?php

namespace Spinen\Version\Commands;

/**
 * Class MetaVersionCommand
 *
 * @package Spinen\Version\Commands
 */
class MetaVersionCommand extends VersionCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'version:meta';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display meta version of the application.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info($this->version->meta);
    }
}
