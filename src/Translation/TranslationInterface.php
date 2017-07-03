<?php

namespace Translator\Translation;

use Translator\Group\GroupInterface;

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
     * @return string
     */
    public function getLanguage(): string;

    /**
     * @return string
     */
    public function getTranslation(): string;
}