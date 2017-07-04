<?php

require_once dirname(__FILE__) . '/config.php';

$group = new \Translator\Group('category test');

$translator = new \Translator\Translator();

$translation = new \Translator\Translation();
$translation->setAbstractName('test Abstract 11111');
$translation->setOriginalValue('test original 11111');
$translation->setComment('test comment');
$translation->addGroup($group);

$collection = new \Translator\Collection();
$collection->add($translation);

$result = $translator->send($collection);

var_dump($result);
