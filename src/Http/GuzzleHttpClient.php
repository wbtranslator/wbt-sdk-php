<?php

namespace Translator\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Translator\Exceptions\TranslatorValidationException;

class GuzzleHttpClient extends Client
{
    protected $token;

    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    public function request($method, $uri = '', array $options = [])
    {
        $uri = $this->token . '/' . ltrim($uri, '/');

        try {
            return parent::request($method, $uri, $options);
        } catch (ClientException $e) {
            $body = json_decode($e->getResponse()->getBody(), true);

            if ($e->getResponse()->getStatusCode() == 422) {
                $message = !empty($body['message']) ? is_array($body['message'])
                    ? $body['message'][key($body['message'])][0] : $body : '';

                throw new TranslatorValidationException($message);
            }
        }
    }
}