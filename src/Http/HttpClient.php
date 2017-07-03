<?php
namespace Translator\Http;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Translator\Exceptions\TranslatorException;

/**
 * Class TranslatorClient
 */
class HttpClient
{
    /**
     * @const string
     */
    const BASE_API_URL = 'http://fnukraine.pp.ua/api/v2/';

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
            'base_uri' => self::BASE_API_URL
        ]);
    }

    /**
     * Returns the base API URL.
     *
     * @return string
     */
    public static function getBaseApiUrl()
    {
        return self::BASE_API_URL;
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

    /**
     * Prepares the API request for sending to the client handler.
     *
     * @param Request $request
     *
     * @return array
     */
    public function prepareRequest(Request $request)
    {
        $url = $request->getEndpoint() . '?api_key=' . $request->getApiKey();

        return [
            $url,
            $request->getMethod(),
            $request->getHeaders(),
            $request->isAsyncRequest(),
        ];
    }

    /**
     * Send an API request and process the result.
     *
     * @param Request $request
     *
     * @throws TranslatorException
     *
     * @return Response
     */
    public function sendRequest(Request $request)
    {
        list($url, $method, $headers, $isAsyncRequest) = $this->prepareRequest($request);

        $timeOut = $request->getTimeOut();
        $connectTimeOut = $request->getConnectTimeOut();

        if ($method === 'POST') {
            $options = $request->getPostParams();
        } else {
            $options = ['query' => $request->getParams()];
        }

        $rawResponse = $this->client->send($url, $method, $headers, $options, $timeOut, $isAsyncRequest, $connectTimeOut);
        $returnResponse = $this->getResponse($request, $rawResponse);
        if ($returnResponse->isError()) {
            throw $returnResponse->getThrownException();
        }
        return $returnResponse;
    }
}