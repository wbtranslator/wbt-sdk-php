<?php

require_once dirname(__FILE__) . '/config.php';

$files = $sdk->locator()->scan();

if ($files) {
    $result = $sdk->translations()->upload($files);
    var_dump($result);
}

