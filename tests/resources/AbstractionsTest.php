<?php

namespace WBTranslator\Sdk\Tests\PhpUnit\Resources;

use WBTranslator\Sdk\Collection;
use WBTranslator\Sdk\Group;
use WBTranslator\Sdk\Resources\Abstractions;
use WBTranslator\Sdk\Resources\Translations;
use WBTranslator\Sdk\Tests\Helpers\Mocks;
use WBTranslator\Sdk\Tests\Helpers\TestHelpers;
use WBTranslator\Sdk\Translation;

class AbstractionsTest extends Mocks
{
    protected $data;
    protected $abstractions;

    protected function setUp()
    {
        $group = new Group();
        $group->setName('group1');

        $translation = new Translation();
        $translation->setAbstractName('abstract_name1');
        $translation->setOriginalValue('original_value1');
        $translation->addGroup($group);

        $this->data = new Collection();
        $this->data->add($translation);

        $this->abstractions = $this->resources(Abstractions::class, $this->data->toArray());

    }

    public function testCreate()
    {
        $result = $this->abstractions->create($this->data);

        $this->assertEquals($this->data->first()->getAbstractName(), $result->first()->getAbstractName());
    }
}
