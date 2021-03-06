<?php
declare(strict_types=1);

namespace WBTranslator\Sdk;

use WBTranslator\Sdk\Interfaces\GroupInterface;
use WBTranslator\Sdk\Interfaces\TranslationInterface;

/**
 * Class Translation
 *
 * @package WBTranslator
 */
class Translation implements TranslationInterface
{
    /**
     * @var string
     */
    protected $abstractName;
    
    /**
     * @var string
     */
    protected $originalValue;
    
    /**
     * @var string
     */
    protected $language;
    
    /**
     * @var string
     */
    protected $translation;
    
    /**
     * @var string
     */
    protected $comment;
  
    /**
     * @var GroupInterface
     */
    protected $group;

    /**
     * @return string
     */
    public function getAbstractName(): string
    {
        return (string) $this->abstractName;
    }

    /**
     * @param string $abstractName
     * @return Translation
     */
    public function setAbstractName(string $abstractName)
    {
        $this->abstractName = $abstractName;

        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalValue(): string
    {
        return (string) $this->originalValue;
    }

    /**
     * @param string $originalValue
     * @return Translation
     */
    public function setOriginalValue(string $originalValue)
    {
        $this->originalValue = $originalValue;

        return $this;
    }
    
    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return (string) $this->language;
    }
    
    /**
     * @param string $language
     * @return Translation
     */
    public function setLanguage(string $language)
    {
        $this->language = $language;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getTranslation(): string
    {
        return (string) $this->translation;
    }
    
    /**
     * @param string $translation
     * @return Translation
     */
    public function setTranslation(string $translation)
    {
        $this->translation = $translation;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getComment(): string
    {
        return (string) $this->comment;
    }

    /**
     * @param string $comment
     * @return Translation
     */
    public function setComment(string $comment)
    {
        $this->comment = $comment;

        return $this;
    }
 
    /**
     * @return GroupInterface
     */
    public function getGroup(): GroupInterface
    {
        return $this->group;
    }
    
    /**
     * @param GroupInterface $group
     * @return Translation
     */
    public function addGroup(GroupInterface $group)
    {
        $this->group = $group;
        
        return $this;
    }
    
    /**
     * @return bool
     */
    public function hasGroup(): bool
    {
        return !empty($this->group) ?: false;
    }

    public function removeGroup()
    {
        unset($this->group);

        return $this;
    }
}
