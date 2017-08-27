<?php

require_once dirname(__FILE__) . '/config.php';

use WBTranslator\Sdk\Group;

try {
    $result = $sdk->translations()->all();
    var_dump($result);
    
    $result = $sdk->translations()->byLanguage('en');
    var_dump($result);

    $group = new Group();
    $group->setName('test_group');
    $result = $sdk->translations()->byGroup($group);
    var_dump($result);

    $result = $sdk->translations()->one('test2', 'en');
    var_dump($result);

} catch (\Exception $e) {
    print $e->getMessage() . PHP_EOL;
}

