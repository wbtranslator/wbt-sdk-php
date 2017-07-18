<?php

use WebTranslator\Group;
use WebTranslator\Collection;

require_once dirname(__FILE__) . '/config.php';

try {
    $collection = new Collection(['test_category1', 'test_category2', 'test_category3']);
    
    $result = $translator->groups()->create($collection);
    var_dump($result);
} catch (\Exception $e) {
    print $e->getMessage() . PHP_EOL;
}

