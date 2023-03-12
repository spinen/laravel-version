<?php

namespace Spinen\Version\Commands;

use Illuminate\Console\Command;
use Spinen\Version\Version;

/**
 * Class VersionCommand
 */
class VersionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'version';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display version of the application.';

    /**
     * The Version instance
     */
    protected Version $version;

    /**
     * Create a new command instance.
     */
    public function __construct(Version $version)
    {
        parent::__construct();

        $this->version = $version;
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info($this->version->version);
    }
}
