<?php

namespace Translator\Translation;

/**
 * Interface TranslationDetailsInterface
 */
interface TranslationDetailsInterface
{
    /**
     * @return string
     */
    public function getLanguage(): string;

   /**
     * @return string
     */
    public function getTranslation(): string;
}