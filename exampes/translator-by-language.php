<?php

require_once dirname(__FILE__) . '/config.php';

$translator = new \Translator\Translator();
$result = $translator->byLanguage('be');

var_dump($result);
