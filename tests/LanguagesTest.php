<?php

namespace WebTranslator\Tests;

use WebTranslator\Resources\Languages;
use WebTranslator\Tests\Helpers\Mocks;
use WebTranslator\Tests\Helpers\TestHelpers;

class LanguagesTest extends Mocks
{
    protected $data;
    protected $languages;

    protected function setUp()
    {
        $this->data = TestHelpers::toObject(['languages' => [['code' => 'en'], ['code' => 'fr']]]);
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
