<?php

require_once dirname(__FILE__) . '/config.php';

$translator = new \Translator\Translator(API_KEY);
$result = $translator->all();

var_dump($result);
