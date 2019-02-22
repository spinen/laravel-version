<?php

namespace Spinen\Version\Commands;

use Illuminate\Contracts\Foundation\Application;
use Mockery;
use Spinen\Version\Commands\Stubs\VersionCommandStub as VersionCommand;
use Spinen\Version\TestCase;
use Spinen\Version\Version;
use Symfony\Component\Console\Formatter\OutputFormatterInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class VersionCommandTests extends TestCase
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

        $this->command = new VersionCommand($this->version_mock);
        $this->command->setLaravel($this->laravel_mock);
        $this->command->setInput($this->input_mock);
        $this->command->setOutput($this->output_mock);
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

    /**
     * @test
     */
    public function it_can_be_constructed()
    {
        $this->assertInstanceOf(VersionCommand::class, $this->command);
    }
}
