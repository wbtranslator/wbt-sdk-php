<?php
declare(strict_types=1);

namespace WBTranslator\Sdk;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use WBTranslator\Sdk\Interfaces\ConfigInterface;

/**
 * Class Config
 *
 * @package WBTranslator
 */
class Config implements ConfigInterface
{
    /**
     * @const string Default api url.
     */
    const API_URL = 'http://wbtranslator.com/api/project/';
    
    /**
     * Format lang files
     */
    const DEFAULT_FORMAT = 'phparray';
    
    /**
     * Group delimiter
     */
    const DEFAULT_DELIMITER = '::';
    
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
    protected $locale;
    
    /**
     * @var string
     */
    protected $format;
   
    /**
     * @var string
     */
    protected $delimiter;
    
    /**
     * @var Collection
     */
    protected $langPaths;
    
    /**
     * Config constructor.
     */
    public function __construct()
    {
        $this->format = self::DEFAULT_FORMAT;
        $this->delimiter = self::DEFAULT_DELIMITER;
        $this->langPaths = new Collection();

        $this->client = new Client([
            'base_uri' => self::API_URL
        ]);
    }
    
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
        return rtrim($this->basePath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
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
    public function getLocale(): string
    {
        return $this->locale;
    }
    
    /**
     * @param string $locale
     *
     * @return Config
     */
    public function setLocale(string $locale)
    {
        $this->locale = $locale;
    
        return $this;
    }
    
    /**
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }
    
    /**
     * @param string $format
     *
     * @return Config
     */
    public function setFormat(string $format)
    {
        $this->format = $format;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getDelimiter(): string
    {
        return $this->delimiter;
    }
    
    /**
     * @param string $delimiter
     *
     * @return Config
     */
    public function setDelimiter(string $delimiter)
    {
        $this->delimiter = $delimiter;
    
        return $this;
    }
    
    /**
     * @return Collection
     */
    public function getLangPaths(): Collection
    {
        return $this->langPaths;
    }
    
    /**
     * @param array $paths
     *
     * @return Config
     */
    public function setLangPaths($paths)
    {
        if ($paths instanceof Collection) {
            $this->langPaths = $paths;
        }
        
        if (!is_array($paths)) {
            $paths = (array) $paths;
        }
        
        $this->langPaths = new Collection($paths);
        
        return $this;
    }
}
