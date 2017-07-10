<?php

namespace WebTranslator;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use WebTranslator\Interfaces\{
    RequestInterface,
    ResourceInterface
};
use WebTranslator\Resources\{
    Groups,
    Translations
};

/**
 * Class WebTranslator
 *
 * @package WebTranslator
 */
class WebTranslator
{
    /**
     * @const string Version number of the Translator PHP SDK.
     */
    const VERSION = '0.0.2';

    /**
     * @const string Default api endpoint.
     */
    const API_URL = 'http://fnukraine.pp.ua/api/project/';

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
     * WebTranslator constructor.
     *
     * @param string $apiKey
     * @param ClientInterface|null $client
     * @internal param array $config
     */
    public function __construct($apiKey, ClientInterface $client = null)
    {
        $this->apiKey = $apiKey;

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
}
