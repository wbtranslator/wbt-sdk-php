<?php

namespace WBTranslator\Sdk\Tests;

use WBTranslator\Sdk\Resources\Languages;
use WBTranslator\Sdk\Tests\Helpers\Mocks;
use WBTranslator\Sdk\Tests\Helpers\TestHelpers;

class LanguagesTest extends Mocks
{
    protected $data;
    protected $languages;

    protected function setUp()
    {
        $this->data = ['languages' => [['code' => 'en'], ['code' => 'fr']]];
        $this->languages = $this->resources(Languages::class, $this->data);
    }

    public function testAll()
    {
        $all = $this->languages->all();

        $this->assertCount(2, $all);
    }

    public function testTransformResponse()
    {
        $transformResponse = TestHelpers::invokeMethod($this->languages, 'transformResponse', [$this->data]);

        $this->assertCount(2, $transformResponse);
    }
}
