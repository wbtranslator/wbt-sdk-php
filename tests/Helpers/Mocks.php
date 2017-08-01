<?php

namespace WBTranslator\Tests\Helpers;

use PHPUnit\Framework\TestCase;
use WBTranslator\Interfaces\RequestInterface;

abstract class Mocks extends TestCase
{
    /**
     * Get mock of RequestInterface with redefined send method
     *
     * @param $data
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function requestSend($data)
    {
        $request = $this->getMockBuilder(RequestInterface::class)
            ->getMock();

        $request->expects($this->any())
            ->method('send')
            ->willReturn($data);

        return $request;
    }

    /**
     * Mock with redefined method send
     *
     * @param string $className
     * @param $data
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function resources(string $className, $data)
    {
        return $this->getMockBuilder($className)
            ->setMethods(['__constructor'])
            ->setConstructorArgs([$this->requestSend($data)])
            ->getMock();
    }
}
