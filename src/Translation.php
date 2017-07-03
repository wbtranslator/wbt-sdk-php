<?php

namespace Translator;

use Translator\Group\GroupInterface;
use Translator\Translation\TranslationInterface;
use Translator\Collection\CollectionInterface;

class Translation implements TranslationInterface
{
    protected $group;
    protected $comment;
    protected $language;
    protected $translation;
    protected $abstractName;
    protected $originalValue;

    /**
     * @return string
     */
    public function getAbstractName(): string
    {
        return $this->abstractName;
    }

    /**
     * @param string $abstractName
     * @return Translation
     */
    public function setAbstractName($abstractName)
    {
        $this->abstractName = $abstractName;

        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalValue(): string
    {
        return $this->originalValue;
    }

    /**
     * @param string $originalValue
     * @return Translation
     */
    public function setOriginalValue($originalValue)
    {
        $this->originalValue = $originalValue;

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
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     * @return Translation
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return Translation
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return string
     */
    public function getTranslation(): string
    {
        return $this->translation;
    }

    /**
     * @param string $translation
     * @return Translation
     */
    public function setTranslation($translation)
    {
        $this->translation = $translation;

        return $this;
    }
}