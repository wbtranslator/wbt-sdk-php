<?php

use WBTranslator\Sdk\WBTranslatorSdk;

require_once dirname(__FILE__) . '/../vendor/autoload.php';

define('WBT_API_KEY', 'e24e57208721c4a0799589890e786b37');

$client = new \GuzzleHttp\Client([
    'base_uri' => 'http://192.168.88.149:8080/api/project/'
]);

$sdk = new WBTranslatorSdk(WBT_API_KEY, $client ?? null);
