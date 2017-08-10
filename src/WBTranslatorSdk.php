<?php
declare(strict_types=1);

namespace WBTranslator\Sdk;

use WBTranslator\Sdk\Exceptions\WBTranslatorException;
use WBTranslator\Sdk\Interfaces\{
    ConfigInterface, RequestInterface, ResourceInterface
};
use WBTranslator\Sdk\Resources\{
    Groups, Languages, Translations
};

/**
 * Class WBTranslatorSdk
 *
 * @package WBTranslator
 */
class WBTranslatorSdk
{
    /**
     * @const string Version number of the Translator PHP SDK.
     */
    const VERSION = '0.0.3';
    
    /**
     * @var ConfigInterface
     */
    protected $config;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var ResourceInterface Project Groups
     */
    protected $resource;

    /**
     * @var ResourceInterface Project Groups
     */
    protected $groups;

    /**
     * @var ResourceInterface Project Translations
     */
    protected $translations;
    
    /**
     * @var ResourceInterface Project Languages
     */
    protected $languages;
    
    protected $locator;
    
    /**
     * WBTranslator constructor.
     *
     * @param ConfigInterface $config
     *
     * @throws WBTranslatorException
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    
        if (!$this->config->getApiKey()) {
            throw new WBTranslatorException('Required "apiKey" parameter!');
        }
    }
    
    /**
     * @param RequestInterface $request
     */
    public function setRequest(RequestInterface $request)
    {
        $this->request = $request;
    }
    
    /**
     * Returns Request.
     *
     * @return RequestInterface
     */
    public function request()
    {
        if (null === $this->request) {
            $this->request = new Request($this->config->getClient(), $this->config->getApiKey());
        }

        return $this->request;
    }

    /**
     * @return ResourceInterface
     */
    public function resource()
    {
        if (null === $this->resource) {
            $this->resource = new Resource($this->request());
        }

        return $this->resource;
    }

    /**
     * Returns Project Groups.
     *
     * @return ResourceInterface
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
     * @return ResourceInterface
     */
    public function translations()
    {
        if (null === $this->translations) {
            $this->translations = new Translations($this->request());
        }

        return $this->translations;
    }
    
    /**
     * Returns Project Languages.
     *
     * @return ResourceInterface
     */
    public function languages()
    {
        if (null === $this->languages) {
            $this->languages = new Languages($this->request());
        }
        
        return $this->languages;
    }
    
    public function locator()
    {
        if (null === $this->locator) {
            $this->locator = new Locator($this->config);
        }
        
        return $this->locator;
    }
}
