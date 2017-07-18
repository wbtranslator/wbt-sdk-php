<?php

namespace WebTranslator\Tests;

use PHPUnit\Framework\TestCase;
use WebTranslator\Collection;
use WebTranslator\Group;
use WebTranslator\Interfaces\RequestInterface;
use WebTranslator\Request;
use WebTranslator\Resource;
use WebTranslator\Resources\Groups;

/**
 * Class GroupTest
 * @package WebTranslator\Tests
 */
class GroupTest extends TestCase
{
    protected $mockGroup;
    protected $collection;
    protected $group1;
    protected $group2;

    protected function setUp()
    {
        $this->group1 = new Group('Group 1');
        $this->group2 = new Group('Group 2');

        $this->collection = new Collection;

        $this->mockGroup = $this->getMockBuilder(Groups::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testAll()
    {
        $this->assertTrue(true);
//        $data = array_merge([$this->group1], [$this->group2]);
//        $this->collection->add($data);
//
//        $this->mockGroup->expects($this->once())
//            ->method('byCriteria')
//            ->with('groups')
//            ->willReturn($this->collection);
//
//        $this->mockGroup->expects($this->once())
//            ->method('all')
//            ->willReturn($this->mockGroup->byCriteria('groups'));
//
//        $this->assertEquals(count($this->mockGroup->all()[0]), count($data));
    }

    public function testCreate()
    {
        $request = $this->getMockBuilder(RequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $request->expects($this->once())
            ->method('send')
            ->willReturn([['name' => 'yura']]);

        $resource = $this->getMockBuilder(Groups::class)
            ->setMethods(['__constructor'])
            ->setConstructorArgs([$request])
            ->getMock();

        var_dump($resource->all());die;

    }
}