<?php

use WBTranslator\Sdk\Translation;
use WBTranslator\Sdk\Collection;
use WBTranslator\Sdk\Group;

require_once dirname(__FILE__) . '/config.php';

$files = $sdk->locator()->scan();

// Upload translation
$result = $sdk->abstractions()->upload($files);

var_dump($result);

