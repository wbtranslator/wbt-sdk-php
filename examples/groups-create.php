<?php

use WBTranslator\Sdk\Group;
use WBTranslator\Sdk\Collection;

require_once dirname(__FILE__) . '/config.php';

$group1 = new Group();
$group1->setName('test_category1');

$group2 = new Group();
$group2->setName('test_category2');

$group3 = new Group();
$group3->setName('test_category3');
$group3->addParent($group2);

$group4 = new Group();
$group4->setName('test_category4');
$group4->addParent($group2);

$collection = new Collection([$group1, $group3, $group4]);

$result = $sdk->groups()->create($collection);
var_dump($result);
