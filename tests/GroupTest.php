<?php

namespace WBTranslator\Tests;

use WBTranslator\Collection;
use WBTranslator\Resources\Groups;
use WBTranslator\Tests\Helpers\Mocks;
use WBTranslator\Tests\Helpers\TestHelpers;

class GroupTest extends Mocks
{
    protected $data;
    protected $groups;

    protected function setUp()
    {
        $this->data = TestHelpers::toObject([['name' => 'cats'], ['name' => 'dogs']]);
        $this->groups = $this->resources(Groups::class, $this->data);
    }

    public function testAll()
    {
        $groups = $this->groups->all();

        $this->assertCount(2, $groups);

        return $groups;
    }

    /**
     * @depends testAll
     * @param Collection $groups
     */
    public function testCreate($groups)
    {
        $this->assertCount(2, $this->groups->create($groups));
    }

    public function testTransformResponse()
    {
        $transformResponse = TestHelpers::invokeMethod($this->groups, 'transformResponse', [$this->data]);

        $this->assertCount(2, $transformResponse);
    }
}