<?php

namespace Translator\Http;

use GuzzleHttp\Client;

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

        return parent::request($method, $uri, $options);
    }
}