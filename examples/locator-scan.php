<?php

require_once dirname(__FILE__) . '/config.php';

$result = $sdk->locator()->scan();

var_dump($result);
