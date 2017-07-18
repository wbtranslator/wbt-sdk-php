<?php

use WebTranslator\WebTranslator;

require_once dirname(__FILE__) . '/../vendor/autoload.php';

define('TRANSLATOR_API_KEY', '76d04ed18e7f0203e18f3b37ded5ae06');
$client = null;

$client = new \GuzzleHttp\Client([
    'base_uri' => 'http://192.168.88.149:8080/api/project/'
]);

$translator = new WebTranslator(TRANSLATOR_API_KEY, $client);
