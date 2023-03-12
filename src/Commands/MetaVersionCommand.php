<?php

namespace Spinen\Version\Commands;

/**
 * Class MetaVersionCommand
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
     */
    public function handle(): void
    {
        $this->info($this->version->meta);
    }
}
