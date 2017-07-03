<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';

$translator = new \Translator\Translator('37bc765476be6ecc243ac424a0e9f0f0');
$result = $translator->byLanguage('en');

var_dump($result);
