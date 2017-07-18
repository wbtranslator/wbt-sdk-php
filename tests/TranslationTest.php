<?php

namespace WebTranslator\tests;

class TranslationTest extends Mocks
{
    protected $data;

    protected function setUp()
    {
        $object = new \stdClass();
        $translations = new \stdClass();
        $object->abstract_name = 'abstract_name1';
        $object->original_value = 'original_value1';
        $object->group = 'group1';
        $object->translations = [$translations];
        $translations->language = 'language1';
        $translations->value = 'value1';

        $this->data = $object;
    }

    //todo
    public function testAll()
    {
        $all = $this->translations([$this->data])->all();

        $this->assertTrue(true);
    }


}