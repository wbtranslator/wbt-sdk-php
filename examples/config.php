<?php

use WebTranslator\WebTranslator;

require_once dirname(__FILE__) . '/../vendor/autoload.php';

define('TRANSLATOR_API_KEY', '4fd8f2d2cf84c3c1eb54cfd499b2f441');
$client = null;

$client = new \GuzzleHttp\Client([
    'base_uri' => 'http://192.168.88.149:8080/api/project/'
]);

$translator = new WebTranslator(TRANSLATOR_API_KEY, $client);
