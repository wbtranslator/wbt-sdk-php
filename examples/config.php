<?php

use WBTranslator\Sdk\WBTranslatorSdk;
use WBTranslator\Sdk\Config;

require_once dirname(__FILE__) . '/../vendor/autoload.php';

define('WBT_API_KEY', '*****YOUR_PROJECT_API_KEY*****');

$client = new \GuzzleHttp\Client([
    'base_uri' => 'http://wbtranslator.dev/api/project/'
]);

$config = new Config;
$config->setApiKey(WBT_API_KEY);
$config->setClient($client);
$config->setBasePath('/www/myproject');
$config->setLocale('en');
$config->setLangPaths([
    '/resources/lang'
]);

$sdk = new WBTranslatorSdk($config);
