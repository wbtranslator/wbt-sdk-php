<?php

namespace WBTranslator;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use WBTranslator\Exceptions\WBTranslatorException;
use WBTranslator\Interfaces\{
    RequestInterface, ResourceInterface
};
use WBTranslator\Resources\{
    Groups, Languages, Translations
};

/**
 * Class WBTranslatorSdk
 *
 * @package WBTranslator
 */
class WBTranslatorSdk
{
    /**
     * @const string Version number of the Translator PHP SDK.
     */
    const VERSION = '0.0.3';

    /**
     * @const string Default api url.
     */
    const API_URL = 'http://wbtranslator.com/api/project/';

    /**
     * @var ClientInterface The Translator Http Client service.
     */
    protected $client;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var ResourceInterface Project Groups
     */
    protected $resource;

    /**
     * @var ResourceInterface Project Groups
     */
    protected $groups;

    /**
     * @var ResourceInterface Project Translations
     */
    protected $translations;
    
    /**
     * @var ResourceInterface Project Languages
     */
    protected $languages;
    
    
    /**
     * WBTranslator constructor.
     *
     * @param $apiKey
     * @param ClientInterface|null $client
     *
     * @throws WBTranslatorException
     */
    public function __construct($apiKey, ClientInterface $client = null)
    {
        $this->apiKey = $apiKey;
    
        if (!$this->apiKey) {
            throw new WBTranslatorException('Required "apiKey" parameter!');
        }
        
        $this->client = $client ? $client : new Client([
            'base_uri' => self::API_URL
        ]);
    }

    /**
     * Return Api Key.
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Returns the Http Client service.
     *
     * @return ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }
    
    /**
     * @param RequestInterface $request
     */
    public function setRequest(RequestInterface $request)
    {
        $this->request = $request;
    }
    
    /**
     * Returns Request.
     *
     * @return RequestInterface
     */
    public function request()
    {
        if (null === $this->request) {
            $this->request = new Request($this->getClient(), $this->getApiKey());
        }

        return $this->request;
    }

    /**
     * @return ResourceInterface
     */
    public function resource()
    {
        if (null === $this->resource) {
            $this->resource = new Resource($this->request());
        }

        return $this->resource;
    }

    /**
     * Returns Project Groups.
     *
     * @return ResourceInterface
     */
    public function groups()
    {
        if (null === $this->groups) {
            $this->groups = new Groups($this->request());
        }

        return $this->groups;
    }

    /**
     * Returns Project Translations.
     *
     * @return ResourceInterface
     */
    public function translations()
    {
        if (null === $this->translations) {
            $this->translations = new Translations($this->request());
        }

        return $this->translations;
    }
    
    /**
     * Returns Project Languages.
     *
     * @return ResourceInterface
     */
    public function languages()
    {
        if (null === $this->languages) {
            $this->languages = new Languages($this->request());
        }
        
        return $this->languages;
    }
}
