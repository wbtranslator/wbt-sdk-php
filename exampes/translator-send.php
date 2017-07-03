<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';

$translator = new \Translator\Translator('37bc765476be6ecc243ac424a0e9f0f0');

$translation = new \Translator\Translation();
$translation->setAbstractName('test Abstract Name222');
$translation->setOriginalValue('test original value3');
$translation->setComment('test comment');
$translation->addGroup(new \Translator\Group('category test'));

$collection = new \Translator\Collection();
$collection->add($translation);

$result = $translator->send($collection);

var_dump($result);
