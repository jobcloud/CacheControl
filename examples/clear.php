<?php
use Crunch\CacheControl\Connector;
use Crunch\FastCGI\Client;

require_once __DIR__ . '/../vendor/autoload.php';

$apc = new Connector(new Client('unix:///var/run/php5-fpm.sock', null));
var_dump($apc->clearCache());
