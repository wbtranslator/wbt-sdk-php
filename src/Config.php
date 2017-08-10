<?php
declare(strict_types=1);

namespace WBTranslator\Sdk;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use WBTranslator\Sdk\Collection;
use WBTranslator\Sdk\Interfaces\ConfigInterface;

class Config implements ConfigInterface
{
    /**
     * @const string Default api url.
     */
    const API_URL = 'http://wbtranslator.com/api/project/';
    
    /**
     * @var string
     */
    protected $apiKey;
    
    /**
     * @var ClientInterface The Translator Http Client service.
     */
    protected $client;
    
    /**
     * @var string
     */
    protected $basePath;
    
    /**
     * @var string
     */
    protected $baseLocale;
    
    /**
     * @var array
     */
    protected $langResourcePaths = [];
    
    /**
     * @var string
     */
    protected $groupDelimiter = '::';
    
    /**
     * Return Api Key.
     *
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }
    
    /**
     * @param string $apiKey
     *
     * @return Config
     */
    public function setApiKey(string $apiKey)
    {
        $this->apiKey = $apiKey;
    
        return $this;
    }
    
    /**
     * Returns the Http Client service.
     *
     * @return ClientInterface
     */
    public function getClient(): ClientInterface
    {
        if (null === $this->client) {
            $this->client = new Client([
                'base_uri' => self::API_URL
            ]);
        }
        
        return $this->client;
    }
    
    /**
     * @param ClientInterface $client
     *
     * @return Config
     */
    public function setClient(ClientInterface$client)
    {
        $this->client = $client;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getBasePath(): string
    {
        return $this->basePath;
    }
    
    /**
     * @param string $path
     *
     * @return Config
     */
    public function setBasePath(string $path)
    {
        $this->basePath = $path;
    
        return $this;
    }
    
    /**
     * @return string
     */
    public function getBaseLocale(): string
    {
        return $this->baseLocale;
    }
    
    /**
     * @param string $locale
     *
     * @return Config
     */
    public function setBaseLocale(string $locale)
    {
        $this->baseLocale = $locale;
    
        return $this;
    }
    
    /**
     * @return array
     */
    public function getLangResourcePaths(): Collection
    {
        return $this->langResourcePaths;
    }
    
    /**
     * @param array $paths
     *
     * @return Config
     */
    public function setLangResourcePaths($paths)
    {
        if ($paths instanceof Collection) {
            $this->langResourcePaths = $paths;
        }
        
        $this->langResourcePaths = new Collection($paths);
    
        return $this;
    }
    
    /**
     * @return string
     */
    public function getGroupDelimiter(): string
    {
        return $this->groupDelimiter;
    }
    
    /**
     * @param string $delimiter
     *
     * @return Config
     */
    public function setGroupDelimiter(string $delimiter)
    {
        $this->groupDelimiter = $delimiter;
    
        return $this;
    }
}
