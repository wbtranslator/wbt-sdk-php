<?php

namespace WebTranslator\tests;

use WebTranslator\Collection;
use WebTranslator\Resources\Translations;

class TranslationTest extends Mocks
{
    protected $data;
    protected $translations;

    protected function setUp()
    {
        $object = new \stdClass();

        $object->abstract_name = 'abstract_name1';
        $object->original_value = 'original_value1';
        $object->group = 'group1';
        $object->translations = [$translations = new \stdClass()];
        $translations->language = 'ua';
        $translations->value = 'value1';

        $this->data = $object;

        $this->translations = $this->translations([$object]);
    }

    public function testAll()
    {
        $all = $this->translations->all();

        $this->assertCount(1, $all);

        return $all;
    }

    public function testByLanguage()
    {
        $language = $this->data->translations[0]->language;
        $byLanguage = $this->translations->byLanguage($language);

        $this->assertInstanceOf(Collection::class, $byLanguage);
        $this->assertEquals($language, $byLanguage[0]->getLanguage());
    }

    public function testByGroup()
    {
        $byGroup = $this->translations->byGroup($this->data->group);

        $this->assertInstanceOf(Collection::class, $byGroup);
        $this->assertEquals($this->data->group, $byGroup[0]->getGroup());
    }

    public function testOne()
    {
        $abstractName = $this->data->abstract_name;
        $language = $this->data->translations[0]->language;
        $translation = $this->data->translations[0]->value;

        $one = $this->translations->one($abstractName, $language);

        $this->assertEquals($translation, $one);
    }

    public function testCreate()
    {
        $create = $this->translations->create($this->testAll());

        $this->assertInstanceOf(Collection::class, $create);
        $this->assertCount(1, $create);
    }

    public function testTransformResponse()
    {
        $translations = $this->createMock(Translations::class);
        $collection = new Collection([$this->data]);

        $transformResponse = TestHelpers::invokeMethod($translations, 'transformResponse', [$collection]);

        $this->assertInstanceOf(Collection::class, $transformResponse);
        $this->assertCount(1, $transformResponse);
    }

}