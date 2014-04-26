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
    $result[OPCACHE] = opcache_reset();
}
if (in_array(APC, $handler)) {
    $result[APC] = apc_clear_cache() && apc_clear_cache('user');
}
if (in_array(APCU, $handler)) {
    $result[APCU] = apc_clear_cache('user');
}

header('CONTENT-TYPE: text/plain');
echo serialize($result);
