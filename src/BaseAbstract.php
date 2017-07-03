<?php

namespace Translator;

use Translator\Exceptions\TranslatorException;
use GuzzleHttp\ClientInterface;

abstract class BaseAbstract
{
    /**
     * @const string Version number of the Translator PHP SDK.
     */
    const VERSION = '0.0.1';

    /**
     * @const string The name of the environment variable that contains the api key.
     */
    const API_KEY = 'TRANSLATOR_API_KEY';

    /**
     * @var string The api_key.
     */
    protected $apiKey;

    /**
     * @var HttpHandler The Translator Http Client service.
     */
    protected $client;

    /**
     * Instantiates a new Translator object.
     *
     * @param string $apiKey
     * @param \GuzzleHttp\ClientInterface $client
     *
     * @throws TranslatorException
     */
    public function __construct($apiKey = null, ClientInterface $client = null)
    {
        $this->apiKey = isset($apiKey) ? $apiKey : getenv(static::API_KEY);

        if (!$this->apiKey) {
            throw new TranslatorException('Required "api_key" key not supplied in config and could not find fallback environment variable "' . static::API_KEY . '"');
        }

        $handler = new HttpHandler($client, $this->apiKey);
        $this->client = $handler->getClient();
    }

    /**
     * Returns the ApiKey.
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Returns the HttpHandler service.
     *
     * @return HttpHandler
     */
    public function getClient()
    {
        return $this->client;
    }
}