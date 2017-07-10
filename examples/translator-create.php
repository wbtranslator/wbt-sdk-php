<?php

use WebTranslator\Group;
use WebTranslator\Translation;
use WebTranslator\Collection;

require_once dirname(__FILE__) . '/config.php';

try {
    $group = new Group('test_category');

    $translation = new Translation();
    $translation->setAbstractName('test_abstract_name222');
    $translation->setOriginalValue('Test Original Value');
    $translation->setComment('Test Comment');
    $translation->addGroup($group);

    $collection = new Collection();
    $collection->add($translation);

    // Send translation
    $result = $translator->translations()->create($collection);

    var_dump($result);
} catch (\Exception $e) {
    print $e->getMessage() . PHP_EOL;
}

