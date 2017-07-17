<?php

namespace WebTranslator;

use WebTranslator\Interfaces\GroupInterface;
use WebTranslator\Interfaces\TranslationInterface;

/**
 * Class Translation
 *
 * @package WebTranslator
 */
class Translation implements TranslationInterface
{
    /**
     * @var GroupInterface
     */
    protected $group;

    /**
     * @var string
     */
    protected $comment;

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
    protected $abstractName;

    /**
     * @var string
     */
    protected $originalValue;

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
        return (string) $this->originalValue;
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
        return (string) $this->comment;
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
        return (string) $this->language;
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
        return (string) $this->translation;
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
