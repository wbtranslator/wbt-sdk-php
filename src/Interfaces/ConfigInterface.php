<?php
declare(strict_types=1);

namespace WBTranslator\Sdk\Interfaces;

use GuzzleHttp\ClientInterface;
use WBTranslator\Sdk\Collection;

/**
 * Interface ConfigInterface
 *
 * @package WBTranslator
 */
interface ConfigInterface
{
    /**
     * @return string
     */
    public function getApiKey(): string;
    
    /**
     * @return ClientInterface
     */
    public function getClient(): ClientInterface;
    
    /**
     * @return string
     */
    public function getBasePath(): string;
    
    /**
     * @return string
     */
    public function getLocale(): string;
    
    /**
     * @return string
     */
    public function getFormat(): string;
    
    /**
     * @return string
     */
    public function getDelimiter(): string;
    
    /**
     * @return Collection
     */
    public function getLangPaths(): Collection;
}
