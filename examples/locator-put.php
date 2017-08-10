<?php

require_once dirname(__FILE__) . '/config.php';

$translations = $sdk->translations()->all();
$result = $sdk->locator()->put($translations);

var_dump($result);
