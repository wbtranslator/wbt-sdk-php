<?php

require_once dirname(__FILE__) . '/config.php';

$group = new \Translator\Group('cat_group');

$translator = new \Translator\Translator();
$result = $translator->byGroup($group);

var_dump($result);