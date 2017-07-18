<?php

namespace WebTranslator\tests;

use PHPUnit\Framework\TestCase;
use WebTranslator\Interfaces\RequestInterface;
use WebTranslator\Resources\Groups;
use WebTranslator\Resources\Languages;
use WebTranslator\Resources\Translations;

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
    private function resources(string $className, $data)
    {
        return $this->getMockBuilder($className)
            ->setMethods(['__constructor'])
            ->setConstructorArgs([$this->requestSend($data)])
            ->getMock();
    }

    /**
     * Mock Resources\Groups with redefined method send
     *
     * @param $data
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function groups($data)
    {
        return $this->resources(Groups::class, $data);
    }

    /**
     * Mock Resources\Language with redefined method send
     *
     * @param $data
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function languages($data)
    {
        return $this->resources(Languages::class, $data);
    }

    /**
     * Mock Resources\Language with redefined method send
     *
     * @param $data
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function translations($data)
    {
        return $this->resources(Translations::class, $data);
    }


}