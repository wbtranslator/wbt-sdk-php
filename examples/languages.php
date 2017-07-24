<?php

require_once dirname(__FILE__) . '/config.php';

$result = $translator->languages()->all();
var_dump($result);
