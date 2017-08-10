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
    public function getBaseLocale(): string;
    
    /**
     * @return string
     */
    public function getGroupDelimiter(): string;
    
    /**
     * @return Collection
     */
    public function getLangResourcePaths(): Collection;
}
