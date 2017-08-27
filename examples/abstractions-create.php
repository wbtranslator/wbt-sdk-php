<?php

use WBTranslator\Sdk\Translation;
use WBTranslator\Sdk\Collection;
use WBTranslator\Sdk\Group;

require_once dirname(__FILE__) . '/config.php';

$group1 = new Group();
$group1->setName('test_category1');

$translation = new Translation();
$translation->setAbstractName('test_abstract_name222a');
$translation->setOriginalValue('Test Original Value');
$translation->setComment('Test Comment');
$translation->addGroup($group1);

$collection = new Collection();
$collection->add($translation);

// Send translation
$result = $sdk->abstractions()->create($collection);

var_dump($result);

