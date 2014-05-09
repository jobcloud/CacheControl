<?php
namespace Crunch\CacheControl;

use Crunch\CacheControl\Console\ClearCommand;
use Crunch\CacheControl\Console\Helper\CacheControlHelper;
use Crunch\CacheControl\Console\StatusCommand;
use Symfony\Component\Console\Application;

(@include_once __DIR__ . '/../vendor/autoload.php') || @include_once __DIR__ . '/../../../autoload.php';

$console = new Application;

$console->getHelperSet()->set(new CacheControlHelper());

$console->addCommands(array(new ClearCommand(), new StatusCommand()));

$console->run();
