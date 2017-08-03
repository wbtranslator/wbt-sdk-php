<?php
declare(strict_types=1);

namespace WBTranslator;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use WBTranslator\Interfaces\RequestInterface;
use WBTranslator\Exceptions\ {
    WBTranslatorException,
    ConnectException,
    PaymentException,
    ValidationException,
    AuthorizationException
};

/**
 * Class Request
 *
 * @package WBTranslator
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
     * @throws AuthorizationException
     * @throws ConnectException
     * @throws WBTranslatorException
     * @throws ValidationException
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

            throw new WBTranslatorException(!empty($body->message) ? $body->message : 'Response Error!');

        } catch (ClientException $e) {
            $body = \json_decode((string) $e->getResponse()->getBody());

            switch ($e->getResponse()->getStatusCode()) {
                // Authorization Exception
                case 401:
                    throw new AuthorizationException(!empty($body->message) ? $body->message : 'Authorization error!', 401);
                    break;
    
                // Payment Exception
                case 402:
                    throw new PaymentException(!empty($body->message) ? [$body->message] : 'Payment error!', 402);
                    break;
                    
                // Connect Exception
                case 404:
                    throw new ConnectException(!empty($body->message) ? $body->message : 'Page Not Found!', 404);
                    break;
    
                // Validation Exception
                case 422:
                    throw new ValidationException(!empty($body->message) ? $body->message : 'Validation error!', 422);
                    break;
                    
                default:
                    throw new ConnectException($e->getMessage());
            }
        } catch (\Exception $e) {
            throw new WBTranslatorException($e->getMessage());
        }
    }
}
