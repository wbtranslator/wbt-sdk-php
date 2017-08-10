<?php

use WBTranslator\Sdk\WBTranslatorSdk;
use WBTranslator\Sdk\Config;

require_once dirname(__FILE__) . '/../vendor/autoload.php';

define('WBT_API_KEY', 'e24e57208721c4a0799589890e786b37');

$client = new \GuzzleHttp\Client([
    'base_uri' => 'http://192.168.88.149:8080/api/project/'
]);

$config = new Config;
$config->setApiKey(WBT_API_KEY);
$config->setClient($client ?? null);
$config->setBasePath('/www/laravel');
$config->setBaseLocale('en');
$config->setLangResourcePaths([
    '/resources/lang'
]);

$sdk = new WBTranslatorSdk($config);
