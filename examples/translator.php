<?php

use WebTranslator\WebTranslator;
use WebTranslator\Group;
use WebTranslator\Collection;

require_once dirname(__FILE__) . '/config.php';

try {
    $translator = new WebTranslator(TRANSLATOR_API_KEY);

    $result = $translator->translations()->all();
    var_dump($result);

    $result = $translator->translations()->byLanguage('en');
    var_dump($result);

    $result = $translator->translations()->byGroup(new Group('cat'));
    var_dump($result);

    $result = $translator->translations()->one('test2', 'en');
    var_dump($result);

} catch (\Exception $e) {
    print $e->getMessage() . PHP_EOL;
}

