<?php

namespace WBTranslator\Sdk\Tests\PhpUnit\Resources;

use WBTranslator\Sdk\Collection;
use WBTranslator\Sdk\Resources\Groups;
use WBTranslator\Sdk\Tests\Helpers\Mocks;
use WBTranslator\Sdk\Tests\Helpers\TestHelpers;

class GroupTest extends Mocks
{
    protected $data;
    protected $groups;

    protected function setUp()
    {
        $this->data = [
            [
                'name' => 'cats',
                'description' => null,
                'parent_id' => null
            ], [
                'name' => 'dogs',
                'description' => null,
                'parent_id' => null
            ]
        ];

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