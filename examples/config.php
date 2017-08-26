<?php

use WBTranslator\Sdk\WBTranslatorSdk;
use WBTranslator\Sdk\Config;

require_once dirname(__FILE__) . '/../vendor/autoload.php';

define('WBT_API_KEY', 'ea84db77506cd5bc8586af4ec4b7a347');

$client = new \GuzzleHttp\Client([
    'base_uri' => 'http://localhost/api/project/'
]);

$config = new Config;
$config->setApiKey(WBT_API_KEY);
//$config->setClient($client);
$config->setBasePath('/Users/sergiy/www/futurenet/web.translator');
$config->setLocale('en');
$config->setLangPaths([
    '/resources/lang'
]);

$sdk = new WBTranslatorSdk($config);
