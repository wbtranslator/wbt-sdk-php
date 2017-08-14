<?php

namespace WBTranslator\Sdk\Tests\PhpUnit\Resources;

use WBTranslator\Sdk\Collection;
use WBTranslator\Sdk\Group;
use WBTranslator\Sdk\Resources\Translations;
use WBTranslator\Sdk\Tests\Helpers\Mocks;
use WBTranslator\Sdk\Tests\Helpers\TestHelpers;

class TranslationTest extends Mocks
{
    protected $data;
    protected $group;
    protected $translations;

    protected function setUp()
    {
        $this->data = [
            'abstract_name' => 'abstract_name1',
            'original_value' => 'original_value1',
            'group' => [
                'name' => 'group1',
                'parent_id' => null,
            ],
            'language' => 'en',
            'translations' => [[
                'language' => 'ua',
                'value' => 'value1'
            ]]
        ];

        $this->translations = $this->resources(Translations::class, [$this->data]);

        $group = new Group();
        $this->group = $group->setFromArray(['name' => 'group1', 'parent_id' => null]);
    }

    public function testAll()
    {
        $all = $this->translations->all();

        $this->assertCount(1, $all);

        return $all;
    }

    public function testByLanguage()
    {
        $language = $this->data['translations'][0]['language'];
        $byLanguage = $this->translations->byLanguage($language);

        $this->assertInstanceOf(Collection::class, $byLanguage);
        $this->assertEquals($language, $byLanguage[0]->getLanguage());
    }

    public function testByGroup()
    {
        $byGroup = $this->translations->byGroup($this->group);

        $this->assertInstanceOf(Collection::class, $byGroup);
        $this->assertEquals($this->data['group']['name'], $byGroup[0]->getGroup()->getName());
    }

    public function testOne()
    {
        $abstractName = $this->data['abstract_name'];

        $language = $this->data['translations'][0]['language'];
        $translation = $this->data['translations'][0]['value'];

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
