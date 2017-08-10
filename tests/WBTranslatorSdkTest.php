<?php

namespace WBTranslator\Sdk\Tests;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\ClientInterface;
use WBTranslator\Sdk\Config;
use WBTranslator\Sdk\WBTranslatorSdk;
use WBTranslator\Sdk\Interfaces\ResourceInterface;
use WBTranslator\Sdk\Interfaces\RequestInterface;

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
        $config = new Config;
        $config->setApikey($this->apiKey);
        
        $sdk = new WBTranslatorSdk($config);

        $this->assertEquals($config->getApiKey(), $this->apiKey);

        return $sdk;
    }

    /**
     * @depends testWebTranslator
     * @param WBTranslatorSdk $translator
     */
    public function testRequest(WBTranslatorSdk $sdk)
    {
        $this->assertInstanceOf(RequestInterface::class, $sdk->request());
    }

    /**
     * @depends testWebTranslator
     * @param WBTranslatorSdk $translator
     */
    public function testResource(WBTranslatorSdk $sdk)
    {
        $this->assertInstanceOf(ResourceInterface::class, $sdk->resource());
    }

    /**
     * @depends testWebTranslator
     * @param WBTranslatorSdk $translator
     */
    public function testTranslations(WBTranslatorSdk $sdk)
    {
        $this->assertInstanceOf(ResourceInterface::class, $sdk->translations());
    }

    /**
     * @depends testWebTranslator
     * @param WBTranslatorSdk $translator
     */
    public function testGroups(WBTranslatorSdk $sdk)
    {
        $this->assertInstanceOf(ResourceInterface::class, $sdk->groups());
    }
}
