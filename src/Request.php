<?php

namespace WebTranslator;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use WebTranslator\Interfaces\RequestInterface;
use WebTranslator\Exceptions\ {
    TranslatorException,
    TranslatorConnectException,
    TranslatorValidationException,
    TranslatorAuthorizationException
};

/**
 * Class Request
 *
 * @package WebTranslator
 */
class Request implements RequestInterface
{
    /**
     * @var ClientInterface The Translator Http Client.
     */
    protected $client;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * Request constructor.
     *
     * @param ClientInterface $client
     * @param string $apiKey
     */
    public function __construct(ClientInterface $client, $apiKey = null)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    /**
     * @param string $endpoint
     * @param string $method
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws TranslatorAuthorizationException
     * @throws TranslatorConnectException
     * @throws TranslatorException
     * @throws TranslatorValidationException
     */
    public function send($endpoint, $method = 'GET', array $options = [])
    {
        $uri = sprintf('%s/%s', $this->apiKey, ltrim($endpoint, '/'));

        try {
            $response = $this->client->request($method, $uri, $options);
            $body = \json_decode((string) $response->getBody());

            if ($body->status == 'success') {
                return $body->data;
            }

            throw new TranslatorException(!empty($body->message) ? $body->message : 'Response Error!');

        } catch (ClientException $e) {
            $body = \json_decode((string) $e->getResponse()->getBody());

            if ($e->getResponse()->getStatusCode() == 401) {
                throw new TranslatorAuthorizationException(!empty($body->message) ? $body->message : 'Authorization error!', 401);
            }

            if ($e->getResponse()->getStatusCode() == 422) {
                throw new TranslatorValidationException(!empty($body->message) ? $body->message : 'Validation error!', 422);
            }

            if ($e->getResponse()->getStatusCode() == 404) {
                throw new TranslatorConnectException(!empty($body->message) ? $body->message : 'Page Not Found!', 404);
            }

            throw new TranslatorConnectException($e->getMessage());
        } catch (\Exception $e) {
            throw new TranslatorException($e->getMessage());
        }
    }
}