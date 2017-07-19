<?php

namespace WebTranslator\tests;

use WebTranslator\Resources\Languages;

class LanguagesTest extends Mocks
{
    protected $data;

    protected function setUp()
    {
        $this->data = TestHelpers::getObject(['languages' => [['code' => 'en'], ['code' => 'fr']]]);
    }

    public function testAll()
    {
        $all = $this->languages($this->data)->all();

        $this->assertCount(2, $all);
    }

    public function testTransformResponse()
    {
        $group = $this->createMock(Languages::class);

        $transformResponse = TestHelpers::invokeMethod($group, 'transformResponse', [$this->data]);

        $this->assertCount(2, $transformResponse);
    }
}
