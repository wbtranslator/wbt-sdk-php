<?php

namespace WebTranslator;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use WebTranslator\Interfaces\{
    RequestInterface,
    GroupInterface,
    TranslationInterface
};
use WebTranslator\Resources\{
    Groups,
    Translations
};

/**
 * Class WebTranslator
 *
 * @package WebTranslator
 */
class WebTranslator
{
    /**
     * @const string Version number of the Translator PHP SDK.
     */
    const VERSION = '0.0.2';

    /**
     * @const string Default api endpoint.
     */
    const ENDPOINT = 'http://fnukraine.pp.ua/api/project/';

    /**
     * @var ClientInterface The Translator Http Client service.
     */
    protected $client;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var GroupInterface Project Groups
     */
    protected $groups;

    /**
     * @var TranslationInterface Project Translations
     */
    protected $translations;

    /**
     * WebTranslator constructor.
     *
     * @param string $apiKey
     * @param ClientInterface|null $client
     * @internal param array $config
     */
    public function __construct($apiKey, ClientInterface $client = null)
    {
        $this->apiKey = $apiKey;

        $this->client = $client ? $client : new Client([
            'base_uri' => self::ENDPOINT
        ]);
    }

    /**
     * Return Api Key.
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Returns the Http Client service.
     *
     * @return ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Returns Request.
     *
     * @return RequestInterface
     */
    public function request()
    {
        if (null === $this->request) {
            $this->request = new Request($this->getClient(), $this->getApiKey());
        }

        return $this->request;
    }

    /**
     * Returns Project Groups.
     *
     * @return GroupInterface
     */
    public function groups()
    {
        if (null === $this->groups) {
            $this->groups = new Groups($this->request());
        }

        return $this->groups;
    }

    /**
     * Returns Project Translations.
     *
     * @return TranslationInterface
     */
    public function translations()
    {
        if (null === $this->translations) {
            $this->translations = new Translations($this->request());
        }

        return $this->translations;
    }
}
