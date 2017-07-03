<?php
namespace Translator;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

/**
 * Class HttpHandler.
 */
class HttpHandler
{
    /**
     * @const string
     */
    const BASE_API_URL = 'http://fnukraine.pp.ua/api/v2/project/';

    /**
     * @var \GuzzleHttp\ClientInterface $client The client for making the HTTP request.
     */
    private $client;

    /**
     * @param \GuzzleHttp\ClientInterface $client
     */
    public function __construct(ClientInterface $client = null)
    {
        $this->client = $client ?: new Client([
            'base_uri' => $this->getBaseApiUrl()
        ]);
    }

    /**
     * Returns the base API URL.
     *
     * @return string
     */
    public static function getBaseApiUrl()
    {
        return getenv('TRANSLATOR_BASE_API_URL') ? getenv('TRANSLATOR_BASE_API_URL') : self::BASE_API_URL;
    }

    /**
     * Return HttpClient
     *
     * @return Client|ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }
}