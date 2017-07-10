<?php

require_once dirname(__FILE__) . '/config.php';

$result = $translator->groups()->all();
var_dump($result);
