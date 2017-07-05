<?php

require_once dirname(__FILE__) . '/config.php';

putenv('TRANSLATOR_API_KEY=bad_api_key');

try {
    $translator = new \Translator\Translator();
    $translator->all();
} catch (\Translator\Exceptions\TranslatorAuthorizationException $e) {
    print 'TRANSLATOR ERROR AUTHORISATION: ' . $e->getMessage() . PHP_EOL;
}
