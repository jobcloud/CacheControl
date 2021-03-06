<?php
namespace Crunch\CacheControl\Console;

use Crunch\CacheControl\Connector;
use PHPUnit_Framework_TestCase as TestCase;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Phake;
use Phake_IMock as Mock;

class ClearCommandTest extends TestCase
{
    /** @var InputInterface|Mock */
    private $input;
    /** @var OutputInterface|Mock */
    private $output;
    /** @var Connector|Mock */
    private $connector;
    /** @var CacheControlHelper|Mock */
    private $helper;

    /** @var ClearCommand|Mock */
    private $subject;

    protected function setUp()
    {
        parent::setUp();
        $this->input = Phake::mock('\Symfony\Component\Console\Input\InputInterface');
        $this->output = Phake::mock('\Symfony\Component\Console\Output\OutputInterface');
        $this->connector = Phake::mock('\Crunch\CacheControl\Connector');
        $this->helper = Phake::mock('\Crunch\CacheControl\Console\Helper\CacheControlHelper');

        $this->subject = phake::partialMock('\Crunch\CacheControl\Console\ClearCommand');

        Phake::when($this->subject)->createConnectorInstance(Phake::anyParameters())->thenReturn($this->connector);
        Phake::when($this->subject)->getHelper('cache-control')->thenReturn($this->helper);
    }

    public function testClearViaHostAndPort()
    {
        Phake::when($this->connector)->clearCache()->thenReturn(array());
        Phake::when($this->input)->getOption('host')->thenReturn('localhost:9000');

        $this->subject->run($this->input, $this->output);

        Phake::verify($this->connector, Phake::times(1))->clearCache();
        Phake::verify($this->subject)->createConnectorInstance('localhost', '9000');
    }

    public function testClearViaSocket()
    {
        Phake::when($this->connector)->clearCache()->thenReturn(array());
        Phake::when($this->input)->getOption('host')->thenReturn('unix:///foo/bar');

        $this->subject->run($this->input, $this->output);

        Phake::verify($this->connector, Phake::times(1))->clearCache();
        Phake::verify($this->subject)->createConnectorInstance('unix:///foo/bar', null);
    }

    public function testClearViaSocketPathOnly()
    {
        Phake::when($this->connector)->clearCache()->thenReturn(array());
        Phake::when($this->input)->getOption('host')->thenReturn('/foo/bar');

        $this->subject->run($this->input, $this->output);

        Phake::verify($this->connector, Phake::times(1))->clearCache();
        Phake::verify($this->subject)->createConnectorInstance('unix:///foo/bar', null);
    }
}
