<?php

namespace Spinen\Version\Commands;

use Illuminate\Contracts\Foundation\Application;
use Mockery;
use Spinen\Version\Commands\Stubs\MajorVersionCommandStub as MajorVersionCommand;
use Spinen\Version\Commands\Stubs\MetaVersionCommandStub as MetaVersionCommand;
use Spinen\Version\Commands\Stubs\MinorVersionCommandStub as MinorVersionCommand;
use Spinen\Version\Commands\Stubs\PatchVersionCommandStub as PatchVersionCommand;
use Spinen\Version\Commands\Stubs\PreReleaseVersionCommandStub as PreReleaseVersionCommand;
use Spinen\Version\Commands\Stubs\SemVersionCommandStub as SemVersionCommand;
use Spinen\Version\Commands\Stubs\VersionCommandStub as VersionCommand;
use Spinen\Version\TestCase;
use Spinen\Version\Version;
use Symfony\Component\Console\Formatter\OutputFormatterInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class VersionCommandTest
 *
 * @package Spinen\Version\Commands
 */
class VersionCommandTest extends TestCase
{
    /**
     * @var VersionCommand
     */
    protected $command;

    /**
     * @var Mockery\Mock
     */
    protected $input_mock;

    /**
     * @var Mockery\Mock
     */
    protected $laravel_mock;

    /**
     * @var Mockery\Mock
     */
    protected $output_formatter_mock;

    /**
     * @var Mockery\Mock
     */
    protected $output_mock;

    /**
     * @var Mockery\Mock
     */
    protected $version_mock;

    public function setup(): void
    {
        parent::setUp();

        $this->setUpMocks();
    }

    private function setUpMocks()
    {
        $this->laravel_mock = Mockery::mock(Application::class);

        $this->input_mock = Mockery::mock(InputInterface::class);

        $this->output_formatter_mock = Mockery::mock(OutputFormatterInterface::class);

        $this->output_mock = Mockery::mock(OutputInterface::class);
        $this->output_mock->shouldReceive('getFormatter')
                          ->andReturn($this->output_formatter_mock);

        $this->version_mock = Mockery::mock(Version::class);
    }

    private function setUpCommand($command)
    {
        $this->command = new $command($this->version_mock);
        $this->command->setLaravel($this->laravel_mock);
        $this->command->setInput($this->input_mock);
        $this->command->setOutput($this->output_mock);
    }

    /**
     * @test
     * @dataProvider versionCommands
     *
     * @param string $command The command being tested
     * @param string $property The property the command exposes
     */
    public function it_gives_the_version($command, $property)
    {
        $this->setUpCommand($command);

        $this->version_mock->{$property} = 'some value';

        $this->output_mock->shouldReceive('writeln')
                          ->once()
                          ->withArgs(
                              [
                                  '<info>some value</info>',
                                  Mockery::any(),
                              ]
                          )
                          ->andReturnNull();

        $this->command->handle();
    }

    public function versionCommands()
    {
        return [
            'Major Version'      => [
                MajorVersionCommand::class,
                'major',
            ],
            'Meta Version'       => [
                MetaVersionCommand::class,
                'meta',
            ],
            'Minor Version'      => [
                MinorVersionCommand::class,
                'minor',
            ],
            'Patch Version'      => [
                PatchVersionCommand::class,
                'patch',
            ],
            'Pre Release Version' => [
                PreReleaseVersionCommand::class,
                'pre_release',
            ],
            'Sem Version'        => [
                SemVersionCommand::class,
                'semver',
            ],
            'Version'           => [
                VersionCommand::class,
                'version',
            ],
        ];
    }
}
