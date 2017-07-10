<?php

use WebTranslator\Group;
use WebTranslator\Collection;

require_once dirname(__FILE__) . '/config.php';

try {
    $group1 = new Group('test_category1');
    $group2 = new Group('test_category2');
    $group3 = new Group('test_category3');

    $collection = new Collection();
    $collection->add($group1);
    $collection->add($group2);
    $collection->add($group3);

    $result = $translator->groups()->create($collection);
    var_dump($result);
} catch (\Exception $e) {
    print $e->getMessage() . PHP_EOL;
}

