<?php

namespace WebTranslator\Tests;

use PHPUnit\Framework\TestCase;
use WebTranslator\WebTranslator;

/**
 * Class WebTranslatorTest
 *
 * @package WebTranslator\Tests
 */
class WebTranslatorTest extends TestCase
{
    protected $apiKey = 'test_api_key';

    /**
     * @return WebTranslator
     */
    public function testWebTranslator()
    {
        $translator = new WebTranslator($this->apiKey);

        $this->assertEquals($this->apiKey, $translator->getApiKey());

        return $translator;
    }

    /**
     * @depends testWebTranslator
     * @param WebTranslator $translator
     */
    public function testGetClient(WebTranslator $translator)
    {
        $this->assertInstanceOf(\GuzzleHttp\ClientInterface::class, $translator->getClient());
    }

    /**
     * @depends testWebTranslator
     * @param WebTranslator $translator
     */
    public function testRequest(WebTranslator $translator)
    {
        $this->assertInstanceOf(\WebTranslator\Interfaces\RequestInterface::class, $translator->request());
    }

    /**
     * @depends testWebTranslator
     * @param WebTranslator $translator
     */
    public function testResource(WebTranslator $translator)
    {
        $this->assertInstanceOf(\WebTranslator\Interfaces\ResourceInterface::class, $translator->resource());
    }

    /**
     * @depends testWebTranslator
     * @param WebTranslator $translator
     */
    public function testTranslations(WebTranslator $translator)
    {
        $this->assertInstanceOf(\WebTranslator\Interfaces\ResourceInterface::class, $translator->translations());
    }

    /**
     * @depends testWebTranslator
     * @param WebTranslator $translator
     */
    public function testGroups(WebTranslator $translator)
    {
        $this->assertInstanceOf(\WebTranslator\Interfaces\ResourceInterface::class, $translator->groups());
    }
}