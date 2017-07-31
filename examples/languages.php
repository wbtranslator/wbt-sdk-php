<?php

require_once dirname(__FILE__) . '/config.php';

$result = $sdk->languages()->all();
var_dump($result);
