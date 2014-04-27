<?php
namespace Crunch\CacheControl\Console;

use Crunch\CacheControl\Connector;
use Crunch\FastCGI\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ClearCommand extends Command
{
    protected $connector;
    protected function configure ()
    {
        $this
            ->setName('clear')
            ->setDescription('Clear Connector cache')
            ->addOption(
                'host',
                null,
                InputOption::VALUE_REQUIRED,
                'Host, either as unix://-path (socket), or hostname[:port] (default port 9000)',
                'unix:///var/run/php5-fpm.sock'
            );
        parent::configure();
    }

    protected function execute (InputInterface $input, OutputInterface $output)
    {
        $info = $this->connector->clearCache();
        foreach ($info as $section => $success) {
            if ($success) {
                $output->writeln("<info>$section OK</info>");
            } else {
                $output->writeln("<error>$section NOT OK</error>");
            }
        }
    }

    protected function initialize (InputInterface $input, OutputInterface $output)
    {
        $host = $input->getOption('host');
        if ($host[0] == '/') {
            $host = 'unix:///' .  ltrim($host, '/');
            $port = null;
        } elseif (substr($host, 0, 7) != 'unix://') {
            list($host, $port) = array_pad(explode(':', $host, 2), 2, 9000);
        } else {
            $port = null;
        }
        $this->connector = $this->createConnectorInstance($host, $port);
        parent::initialize($input, $output);
    }

    protected function createConnectorInstance($host, $port)
    {
        return new Connector(new Client($host, $port));
    }
}
