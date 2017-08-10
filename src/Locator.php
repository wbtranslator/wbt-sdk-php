<?php
declare(strict_types=1);

namespace WBTranslator\Sdk;

use WBTranslator\Sdk\Interfaces\ConfigInterface;
use WBTranslator\Sdk\Interfaces\GroupInterface;
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
     * Locale constructor.
     *
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    
        $this->filesystem = new FilesystemHelper;
    }
    
    /*
     * Scan
     *
     * ==============================================================================================================
     */
    public function scan()
    {
        $collection = new Collection;
        
        foreach ($this->config->getLangResourcePaths() as $localeDirectory) {
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
    
    /**
     * @param $localeDirectory
     */
    protected function getLocalePath($localeDirectory)
    {
        $arr = array_map(function($el) {
            return trim($el, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        }, [
            $this->config->getBasePath(),
            $localeDirectory,
            $this->config->getBaseLocale(),
        ]);
        
        return DIRECTORY_SEPARATOR . implode('', $arr);
    }
    
    /**
     * @param string $path
     * @param null $parent
     *
     * @return \WBTranslator\Sdk\Group
     */
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
    
    /**
     * @param $abstractName
     * @param $originalValue
     * @param $group
     *
     * @return \WBTranslator\Sdk\Translation
     */
    protected function createTranslation($abstractName, $originalValue, $group)
    {
        $translation = new Translation;
        $translation->setAbstractName($abstractName);
        $translation->setOriginalValue(!empty($originalValue) ? (string)$originalValue : '');
        $translation->addGroup($group);
        
        return $translation;
    }
    
    /*
     * Put
     *
     * ==============================================================================================================
     */
    
    /**
     * @param Collection $translations
     */
    public function put(Collection $translations)
    {
        foreach ($this->toArray($translations) as $directory => $files) {
            if (!file_exists($directory)) {
                $this->filesystem->makeDirectory($directory, 0755, true);
            }
            
            foreach ($files as $file => $values) {
                $content = var_export($values, true);
                
                file_put_contents($directory . $file,
                    '<?php' . PHP_EOL . PHP_EOL . "return $content;");
            }
        }
    }
    
    /**
     * @param Collection $translations
     *
     * @return array
     */
    protected function toArray(Collection $translations) :array
    {
        $array = [];
        
        foreach ($translations as $translation) {
            $group = $translation->hasGroup() ? $translation->getGroup() : (new Group)->setName('wbtranslator');
            
            $directory = $this->getPath($translation->getLanguage(), $group);
            $file = $this->getFile($group);
            
            ArrayHelper::set($array[$directory][$file], $translation->getAbstractName(), $translation->getTranslation());
        }
        return $array;
    }
    
    /**
     * @param string $locale
     * @param GroupInterface $group
     *
     * @return string
     */
    protected function getPath(string $locale, GroupInterface $group): string
    {
        $alterGroup = $this->groupToPath($group);
        
        // exlude filename from paths
        array_pop($alterGroup);

        $parentGroup = $group->hasParent() ? $this->groupToPath($group->getParent()) : [];
    
        $arr = array_map(function($el) {
            return trim($el, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        }, [
            $this->config->getBasePath(),
            implode(DIRECTORY_SEPARATOR, $parentGroup),
            $locale,
            implode(DIRECTORY_SEPARATOR, $alterGroup),
        ]);
    
        return DIRECTORY_SEPARATOR . implode('', $arr);

    }
    
    /**
     * @param GroupInterface $group
     *
     * @return string
     */
    protected function getFile(GroupInterface $group): string
    {
        $alterGroup = $this->groupToPath($group);
        
        return ArrayHelper::last($alterGroup) . '.php';
    }
    
    /**
     * @param \WBTranslator\Sdk\Group $group
     *
     * @return array
     */
    protected function groupToPath(Group $group): array
    {
        return explode($this->config->getGroupDelimiter(), $group->getName());
    }
}
