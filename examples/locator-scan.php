<?php

require_once dirname(__FILE__) . '/config.php';

$collection = $sdk->locator()->scan();

/*if ($collection) {
    $result = $sdk->translations()->create($collection);
}*/

var_dump($collection);
