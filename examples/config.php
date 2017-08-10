<?php

use WBTranslator\Sdk\WBTranslatorSdk;
use WBTranslator\Sdk\Config;

require_once dirname(__FILE__) . '/../vendor/autoload.php';

define('WBT_API_KEY', 'd0c15eaaa516fbf5d04c74805af7106c');

$client = new \GuzzleHttp\Client([
    'base_uri' => 'http://192.168.88.149:8080/api/project/'
]);

$config = new Config;
$config->setApiKey(WBT_API_KEY);
$config->setClient($client ?? null);
$config->setBasePath('/www/laravel2');
$config->setBaseLocale('en');
$config->setLangResourcePaths([
    '/resources/lang'
]);

$sdk = new WBTranslatorSdk($config);
