<?php

require_once dirname(__FILE__) . '/config.php';

$result = $sdk->groups()->all();
var_dump($result);
