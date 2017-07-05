<?php
/**
 * Created by PhpStorm.
 * User: future
 * Date: 05.07.17
 * Time: 21:55
 */

namespace Translator;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;
use Translator\Exceptions\TranslatorAuthorizationException;
use Translator\Exceptions\TranslatorConnectException;
use Translator\Exceptions\TranslatorException;
use Translator\Exceptions\TranslatorValidationException;
use Translator\Interfaces\ConfigInterface;
use Translator\Interfaces\HttpClientInterface;

/**
 * Class HttpClient
 * @package Translator
 */
class HttpClient implements HttpClientInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
        $this->client =  new Client([
            'base_uri' => $this->config->getApiUrl()
        ]);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return ResponseInterface
     * @throws TranslatorAuthorizationException
     * @throws TranslatorConnectException
     * @throws TranslatorException
     * @throws TranslatorValidationException
     */
    public function request($method, $uri = '', array $options = [])
    {
        $uri = $this->config->getApiKey() . '/' . ltrim($uri, '/');

        try {
            return $this->client->request($method, $uri, $options);
        } catch (ClientException $e) {
            $body = json_decode($e->getResponse()->getBody(), true);
            $message = !empty($body['message']) ? $body['message'] : '';

            if ($e->getResponse()->getStatusCode() == 401) {
                throw new TranslatorAuthorizationException($message);
            }

            if ($e->getResponse()->getStatusCode() == 422) {
                throw new TranslatorValidationException($message);
            }

            throw new TranslatorConnectException($e->getMessage());
        } catch (\Exception $e) {
            throw new TranslatorException($e->getMessage());
        }
    }
}
