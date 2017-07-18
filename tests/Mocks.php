<?php

namespace WebTranslator\tests;

use PHPUnit\Framework\TestCase;
use WebTranslator\Interfaces\RequestInterface;
use WebTranslator\Resources\Groups;
use WebTranslator\Resources\Languages;

abstract class Mocks extends TestCase
{
    /**
     * Get mock of RequestInterface
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function request()
    {
        return $this->getMockBuilder(RequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * Redefining send method
     *
     * @param $param
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function send($param)
    {
        $request = $this->request();

        $request->expects($this->any())
            ->method('send')
            ->willReturn($param);

        return $request;
    }

    /**
     * Mock Resources\Groups with redefined method send
     *
     * @param $param
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function group($param)
    {
        return $this->getMockBuilder(Groups::class)
            ->setMethods(['__constructor'])
            ->setConstructorArgs([$this->send($param)])
            ->getMock();
    }

    /**
     * Mock Resources\Languages with redefined method send
     *
     * @param $param
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function languages($param)
    {
        return $this->getMockBuilder(Languages::class)
            ->setMethods(['__constructor'])
            ->setConstructorArgs([$this->send($param)])
            ->getMock();
    }




}