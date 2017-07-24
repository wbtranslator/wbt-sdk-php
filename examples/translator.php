<?php

require_once dirname(__FILE__) . '/config.php';

try {
    $result = $translator->translations()->all();
    var_dump($result);

    $result = $translator->translations()->byLanguage('en');
    var_dump($result);

    $result = $translator->translations()->byGroup('cat');
    var_dump($result);

    $result = $translator->translations()->one('test2', 'en');
    var_dump($result);

} catch (\Exception $e) {
    print $e->getMessage() . PHP_EOL;
}

