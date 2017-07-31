<?php

use WBTranslator\WBTranslatorSdk;

require_once dirname(__FILE__) . '/../vendor/autoload.php';

define('WBT_API_KEY', '***API_KEY****');

/*$client = new \GuzzleHttp\Client([
    'base_uri' => 'http://192.168.88.149:8080/api/project/'
]);*/

$sdk = new WBTranslatorSdk(WBT_API_KEY, $client ?? null);
