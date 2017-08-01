<?php

namespace WBTranslator\Tests;

use PHPUnit\Framework\TestCase;
use WBTranslator\WBTranslatorSdk;

/**
 * Class WBTranslatorSdkTest
 *
 * @package WBTranslatorTests
 */
class WBTranslatorSdkTest extends TestCase
{
    protected $apiKey = 'test_api_key';

    /**
     * @return WBTranslatorSdk
     */
    public function testWebTranslator()
    {
        $sdk = new WBTranslatorSdk($this->apiKey);

        $this->assertEquals($this->apiKey, $sdk->getApiKey());

        return $sdk;
    }

    /**
     * @depends testWebTranslator
     * @param WBTranslatorSdk $translator
     */
    public function testGetClient(WBTranslatorSdk $sdk)
    {
        $this->assertInstanceOf(\GuzzleHttp\ClientInterface::class, $sdk->getClient());
    }

    /**
     * @depends testWebTranslator
     * @param WBTranslatorSdk $translator
     */
    public function testRequest(WBTranslatorSdk $sdk)
    {
        $this->assertInstanceOf(\WBTranslator\Interfaces\RequestInterface::class, $sdk->request());
    }

    /**
     * @depends testWebTranslator
     * @param WBTranslatorSdk $translator
     */
    public function testResource(WBTranslatorSdk $sdk)
    {
        $this->assertInstanceOf(\WBTranslator\Interfaces\ResourceInterface::class, $sdk->resource());
    }

    /**
     * @depends testWebTranslator
     * @param WBTranslatorSdk $translator
     */
    public function testTranslations(WBTranslatorSdk $sdk)
    {
        $this->assertInstanceOf(\WBTranslator\Interfaces\ResourceInterface::class, $sdk->translations());
    }

    /**
     * @depends testWebTranslator
     * @param WBTranslatorSdk $translator
     */
    public function testGroups(WBTranslatorSdk $sdk)
    {
        $this->assertInstanceOf(\WBTranslator\Interfaces\ResourceInterface::class, $sdk->groups());
    }
}
