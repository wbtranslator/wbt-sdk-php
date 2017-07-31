<?php

use WebTranslator\Translation;
use WebTranslator\Collection;

require_once dirname(__FILE__) . '/config.php';

$translation = new Translation();
$translation->setAbstractName('test_abstract_name222a');
$translation->setOriginalValue('Test Original Value');
$translation->setComment('Test Comment');
$translation->setGroup('test_category');

$collection = new Collection();
$collection->add($translation);

// Send translation
$result = $translator->translations()->create($collection);

var_dump($result);

