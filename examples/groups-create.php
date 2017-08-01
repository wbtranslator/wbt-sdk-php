<?php

use WBTranslator\Group;
use WBTranslator\Collection;

require_once dirname(__FILE__) . '/config.php';


$collection = new Collection(['test_category1', 'test_category2', 'test_category3']);
    
$result = $sdk->groups()->create($collection);
var_dump($result);
