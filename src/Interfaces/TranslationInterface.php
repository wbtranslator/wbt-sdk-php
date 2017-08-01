<?php

namespace WBTranslator\Interfaces;

/**
 * Interface TranslationInterface
 *
 * @package WBTranslator
 */
interface TranslationInterface
{
    /**
     * @return string
     */
    public function getAbstractName(): string;

    /**
     * @return string
     */
    public function getGroup(): string;

    /**
     * @return string
     */
    public function getLanguage(): string;

    /**
     * @return string
     */
    public function getTranslation(): string;
}
