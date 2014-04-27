<?php
namespace Crunch\CacheControl\Console;

use PHPUnit_Framework_TestCase as TestCase;

class ApplicationTest extends TestCase
{
    public function testStatusCommandRegistered()
    {
        $application = new Application;

        $reflection = new \ReflectionObject($application);
        $method = $reflection->getMethod('getDefaultCommands');
        $method->setAccessible(true);

        $commands = $method->invoke($application);

        $count = 0;
        foreach ($commands as $command) {
            if (get_class($command) == 'Crunch\CacheControl\Console\StatusCommand') {
                $count++;
            }
        }

        $this->assertEquals(1, $count, 'Status command must be registered exactly once');
    }

    public function testClearCommandRegistered()
    {
        $application = new Application;

        $reflection = new \ReflectionObject($application);
        $method = $reflection->getMethod('getDefaultCommands');
        $method->setAccessible(true);

        $commands = $method->invoke($application);

        $count = 0;
        foreach ($commands as $command) {
            if (get_class($command) == 'Crunch\CacheControl\Console\ClearCommand') {
                $count++;
            }
        }

        $this->assertEquals(1, $count, 'Clear command must be registered exactly once');
    }
}
