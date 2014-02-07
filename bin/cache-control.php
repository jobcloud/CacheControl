<?php
namespace Crunch\CacheControl;

(@include_once __DIR__ . '/../vendor/autoload.php') || @include_once __DIR__ . '/../../../autoload.php';

$console = new Console\Application;

$console->run();
