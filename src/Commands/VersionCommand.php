<?php

namespace Spinen\Version\Commands;

use Illuminate\Console\Command;
use Spinen\Version\Version;

/**
 * Class VersionCommand
 *
 * @package Spinen\Version\Commands
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
     *
     * @var Version
     */
    protected $version;

    /**
     * Create a new command instance.
     *
     * @param Version $version
     */
    public function __construct(Version $version)
    {
        parent::__construct();

        $this->version = $version;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info($this->version->version);
    }
}
