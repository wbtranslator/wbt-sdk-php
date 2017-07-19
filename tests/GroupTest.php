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
    protected $groups;

    protected function setUp()
    {
        $this->data = TestHelpers::getObject(['data' => ['name' => 'cats'], ['name' => 'dogs']]);
        $this->groups = $this->groups($this->data);
    }

    public function testAll()
    {
        $all = $this->groups->all();

        $this->assertCount(2, $all);

        return $all;
    }

    public function testCreate()
    {
        $this->assertCount(2, $this->groups->create($this->testAll()));
    }

    public function testTransformResponse()
    {
        $group = $this->createMock(Groups::class);

        $transformResponse = TestHelpers::invokeMethod($group, 'transformResponse', [$this->data]);

        $this->assertCount(2, $transformResponse);
    }
}