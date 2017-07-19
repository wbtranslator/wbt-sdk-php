<?php

namespace WebTranslator\Tests;

use WebTranslator\Collection;
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
        $this->data = TestHelpers::getObject([
            'data' => ['name' => 'cats'], ['name' => 'dogs']
        ]);
        
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
        $group = $this->createMock(Groups::class);

        $transformResponse = TestHelpers::invokeMethod($group, 'transformResponse', [$this->data]);

        $this->assertCount(2, $transformResponse);
    }
}