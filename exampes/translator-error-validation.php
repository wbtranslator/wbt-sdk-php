<?php

require_once dirname(__FILE__) . '/config.php';

try {
    $translator = new \Translator\Translator();
    $translator->one('teetetetet', 1);
} catch (\Translator\Exceptions\TranslatorValidationException $e) {
    print 'TRANSLATOR ERROR VALIDATION: ' . $e->getMessage() . PHP_EOL;
}
