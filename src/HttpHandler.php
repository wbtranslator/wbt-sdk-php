<?php

namespace Translator;

use Translator\Http\GuzzleHttpClient;
use GuzzleHttp\ClientInterface;

/**
 * Class HttpHandler.
 */
class HttpHandler
{
    /**
     * @const string
     */
    const BASE_API_URL = 'http://fnukraine.pp.ua/api/project/';

    /**
     * @var \GuzzleHttp\ClientInterface $client The client for making the HTTP request.
     */
    private $client;

    /**
     * @var string The token.
     */
    protected $token;

    /**
     * @param \GuzzleHttp\ClientInterface $client
     */
    public function __construct(ClientInterface $client = null, $token = null)
    {
        if (null === $client) {
            $client = new GuzzleHttpClient([
                'base_uri' => $this->getBaseApiUrl(),
            ]);
            $client->setToken($token);
        }

        $this->client = $client;
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
     * @return ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }
}