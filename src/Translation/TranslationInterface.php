<?php

namespace Translator\Translation;

use Translator\Group\GroupInterface;
use Translator\Collection\CollectionInterface;

/**
 * Interface TranslationInterface
 */
interface TranslationInterface
{
    /**
     * @return GroupInterface|null
     */
    public function getGroup(): GroupInterface;

   /**
     * @return string
     */
    public function getAbstractName(): string;

   /**
     * @return string
     */
    public function getOriginalValue(): string;

   /**
     * @return string
     */
    public function getComment(): string;

   /**
     * @return TranslationDetailsInterface|CollectionInterface
     */
    public function getDetails(): CollectionInterface;
}