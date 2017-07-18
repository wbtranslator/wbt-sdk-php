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
        $all = $this->groups($this->data)->all();

        $this->assertCount(2, $this->groups($this->data)->all());

        return $all;
    }

    public function testCreate()
    {
        $this->assertCount(2, $this->groups($this->data)->create($this->testAll()));
    }

    public function testTransformResponse()
    {
        $group = $this->createMock(Groups::class);

        $transformResponse = TestHelpers::invokeMethod($group, 'transformResponse', [$this->data]);

        $this->assertCount(2, $transformResponse);
    }
}