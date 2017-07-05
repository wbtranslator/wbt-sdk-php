<?php

namespace Translator\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Translator\Exceptions\TranslatorException;
use Translator\Exceptions\TranslatorConnectException;
use Translator\Exceptions\TranslatorValidationException;
use Translator\Exceptions\TranslatorAuthorizationException;

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
        }
        catch (ClientException $e) {
            $body = json_decode($e->getResponse()->getBody(), true);
            $message = !empty($body['message']) ? $body['message'] : '';

            if ($e->getResponse()->getStatusCode() == 401) {
                throw new TranslatorAuthorizationException($message);
            }

            if ($e->getResponse()->getStatusCode() == 422) {
                throw new TranslatorValidationException($message);
            }

            throw new TranslatorConnectException($e->getMessage());
        }
        catch (\Exception $e) {
            throw new TranslatorException($e->getMessage());
        }
    }
}