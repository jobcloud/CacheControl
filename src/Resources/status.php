<?php
namespace Crunch\CacheControl;

const OPCACHE = 'Zend OPcache';
const APCU = 'apcu';
const APC = 'apc';

$handler = array();

if (extension_loaded(OPCACHE)) {
    $handler[] = OPCACHE;
}
if (extension_loaded(APCU)) {
    $handler[] = APCU;
} elseif (extension_loaded(APC)) {
    $handler[] = APC;
}

$result = array();
if (in_array(OPCACHE, $handler)) {
    $result[OPCACHE] = opcache_get_status(false);
}
if (in_array(APC, $handler)) {
    $result[APC] = array(
        'cache'  => apc_cache_info('user', true),
        'system' => apc_cache_info('system', true),
        'sma'    => apc_sma_info(true),
    );
}
if (in_array(APCU, $handler)) {
    $result[APCU] = array(
        'cache' => apc_cache_info('user'),
        'sma'   => apc_sma_info(true),
    );
}

header('CONTENT-TYPE: text/plain');
echo serialize($result);
