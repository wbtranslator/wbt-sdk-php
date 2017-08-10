<?php
declare(strict_types=1);

namespace WBTranslator\Sdk;

use WBTranslator\Sdk\Interfaces\ConfigInterface;

class Config implements ConfigInterface
{
    protected $basePath;
    
    protected $baseLocale;
    
    protected $formatLangFiles;
    
    protected $langResourcePaths;
    
    public function getBasePath(): string
    {
        return $this->basePath;
    }
    
    public function setBasePath(string $path)
    {
        $this->basePath = $path;
    }
    
    public function getBaseLocale(): string
    {
        return $this->baseLocale;
    }
    
    public function setBaseLocale(string $locale)
    {
        $this->baseLocale = $locale;
    }
    
    public function getLangResourcePaths(): array
    {
        return $this->langResourcePaths;
    }
    
    public function setLangResourcePaths(array $paths)
    {
        $this->langResourcePaths = $paths;
    }
}