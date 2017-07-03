<?php

namespace Translator;

use Translator\Group\GroupInterface;
use Translator\Translation\TranslationInterface;
use Translator\Collection\CollectionInterface;

class Translation implements TranslationInterface
{
    protected $abstractName;
    protected $originalValue;
    protected $group;
    protected $comment;
    protected $details;

    /**
     * @return string
     */
    public function getAbstractName(): string
    {
        return $this->abstractName;
    }

    public function setAbstractName($abstractName)
    {
        $this->abstractName = $abstractName;

        return $this;
    }

    public function getOriginalValue(): string
    {
        return $this->originalValue;
    }

    public function setOriginalValue($originalValue)
    {
        $this->originalValue = $originalValue;

        return $this;
    }

    public function getGroup(): GroupInterface
    {
        return $this->group;
    }

    public function addGroup(GroupInterface $group)
    {
        $this->group = $group;

        return $this;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    public function getDetails(): CollectionInterface
    {
        return $this->details;
    }

    public function addDetails($details)
    {
        $this->details = $details;

        return $this;
    }
}