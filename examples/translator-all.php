<?php

use \WebTranslator\WebTranslator;

require_once dirname(__FILE__) . '/config.php';

try {
    $translator = new WebTranslator(TRANSLATOR_API_KEY);
    $result = $translator->translations()->all();
    var_dump($result);
} catch (\Exception $e) {
    print $e->getMessage() . PHP_EOL;
}

