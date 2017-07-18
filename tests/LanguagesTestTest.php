<?php

namespace WebTranslator\tests;

use WebTranslator\Resources\Groups;
use WebTranslator\Resources\Languages;

class LanguagesTestTest extends Mocks
{
    public function testAll()
    {
        $param = TestHelpers::getObject( ['languages' => [['code' => 'en'], ['code' => 'fr']]]);

        $all = $this->languages($param)->all();

        $this->assertCount(2, $all);
    }

    public function testTransformResponse()
    {
        $group = $this->createMock(Groups::class);
        $data = TestHelpers::getObject(['data' => ['name' => 'cats'], ['name' => 'dogs']]);

        $transformResponse = TestHelpers::invokeMethod($group, 'transformResponse', [$data]);
        $this->assertCount(2, $transformResponse);

    }
}
