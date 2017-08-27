<?php

require_once dirname(__FILE__) . '/config.php';

$files = $sdk->locator()->scan();

var_dump($files);
