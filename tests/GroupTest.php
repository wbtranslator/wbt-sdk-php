<?php

namespace WebTranslator\Tests;

use WebTranslator\Resources\Groups;

/**
 * Class GroupTest
 * @package WebTranslator\Tests
 */
class GroupTest extends Mocks
{
    protected $data;

    protected function setUp()
    {
        $this->data = TestHelpers::getObject(['data' => ['name' => 'cats'], ['name' => 'dogs']]);
    }

    public function testAll()
    {
        $all = $this->group($this->data)->all();

        $this->assertCount(2, $this->group($this->data)->all());

        return $all;
    }

    // todo:
    public function testCreate()
    {
        $param = TestHelpers::getObject([['name' => 'cats'], ['name' => 'dogs']]);

        $create = $this->group($param)->create($this->testAll());

    }

    public function testTransformResponse()
    {
        $group = $this->createMock(Groups::class);

        $transformResponse = TestHelpers::invokeMethod($group, 'transformResponse', [$this->data]);

        $this->assertCount(2, $transformResponse);

    }
}