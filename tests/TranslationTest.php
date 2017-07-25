<?php

namespace WebTranslator\Tests;

use WebTranslator\Collection;
use WebTranslator\Resources\Translations;
use WebTranslator\Tests\Helpers\Mocks;
use WebTranslator\Tests\Helpers\TestHelpers;

class TranslationTest extends Mocks
{
    protected $data;
    protected $translations;

    protected function setUp()
    {
        $this->data = TestHelpers::toObject([
            'abstract_name' => 'abstract_name1',
            'original_value' => 'original_value1',
            'group' => 'group1',
            'translations' => [[
                'language' => 'ua',
                'value' => 'value1'
            ]]
        ]);

        $this->translations = $this->resources(Translations::class, [$this->data]);
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

    /**
     * @depends testAll
     * @param Collection $translations
     */
    public function testCreate($translations)
    {
        $create = $this->translations->create($translations);

        $this->assertInstanceOf(Collection::class, $create);
        $this->assertCount(1, $create);
    }

    public function testTransformResponse()
    {
        $collection = new Collection([$this->data]);

        $transformResponse = TestHelpers::invokeMethod($this->translations, 'transformResponse', [$collection]);

        $this->assertInstanceOf(Collection::class, $transformResponse);
        $this->assertCount(1, $transformResponse);
    }

}