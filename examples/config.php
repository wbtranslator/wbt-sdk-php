<?php

use WebTranslator\WebTranslator;

require_once dirname(__FILE__) . '/../vendor/autoload.php';

define('TRANSLATOR_API_KEY', '08f8ef2e9ba39ab59c352a338423b834');

/*$client = new \GuzzleHttp\Client([
    'base_uri' => 'http://localhost/api/project/'
]);*/

$translator = new WebTranslator(TRANSLATOR_API_KEY);
