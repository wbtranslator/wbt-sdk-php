<?php
declare(strict_types=1);

namespace WBTranslator\Sdk;

use WBTranslator\Sdk\Interfaces\ConfigInterface;
use WBTranslator\Sdk\Group;
use WBTranslator\Sdk\Translation;
use WBTranslator\Sdk\Helper\FilesystemHelper;
use WBTranslator\Sdk\Helper\ArrayHelper;

/**
 * Class Locator
 *
 * @package WBTranslator
 */
class Locator
{
    /**
     * @var ConfigInterface
     */
    protected $config;
    
    /**
     * @var Filesystem
     */
    protected $filesystem;
    
    /**
     * @var array
     */
    protected $langPaths = [];

    /**
     * Locale constructor.
     *
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    
        $this->filesystem = new FilesystemHelper;
    }
    
    public function scan()
    {
        $collection = new Collection;
        
        foreach ($this->langPaths() as $localeDirectory) {
            if (!file_exists($basePath = $this->getLocalePath($localeDirectory))) {
                continue;
            }
            
            $rootGroup = $this->createGroup($localeDirectory);
            
            foreach ($this->filesystem->getAllFiles($basePath) as $file) {
                $data = $this->filesystem->getRequire($file['absolutePathname']);
                
                if (file_exists($file['absolutePathname'])) {
                    if (!empty($data) && is_array($data)) {
                        $group = $this->createGroup($file['relativePathname'], $rootGroup);
                        
                        foreach ((ArrayHelper::dot($data)) as $abstractName => $originalValue) {
                            if (!$abstractName) {
                                continue;
                            }
                            
                            $translation = $this->createTranslation($abstractName, $originalValue, $group);
                            $collection->add($translation);
                        }
                    }
                }
            }
        }
        return $collection;
    }
    
    public function langPaths(): array
    {
        if (!empty($this->config->getLangResourcePaths())) {
            $this->langPaths = array_map(function($el) {
                return rtrim($el, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
            }, $this->config->getLangResourcePaths());
        }
        
        return $this->langPaths;
    }
    
    protected function getLocalePath($localeDirectory)
    {
        return $this->config->getBasePath() . $localeDirectory . $this->config->getBaseLocale() . DIRECTORY_SEPARATOR;
    }
    
    protected function createGroup(string $path, $parent = null)
    {
        $path = trim($path, DIRECTORY_SEPARATOR);
        $name = str_replace([DIRECTORY_SEPARATOR, '.php'], [$this->config->getGroupDelimiter(), ''], $path);
        
        $group = new Group();
        $group->setName($name);
        
        if (null !== $parent) {
            $group->addParent($parent);
        }
        
        return $group;
    }
    
    protected function createTranslation($abstractName, $originalValue, $group)
    {
        $translation = new Translation;
        $translation->setAbstractName($abstractName);
        $translation->setOriginalValue(!empty($originalValue) ? (string)$originalValue : '');
        $translation->addGroup($group);
        
        return $translation;
    }
}
