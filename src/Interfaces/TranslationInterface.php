<?php

namespace Translator\Interfaces;

/**
 * Interface TranslationInterface
 *
 * @package Translator
 */
interface TranslationInterface
{
    /**
     * @return string
     */
    public function getAbstractName();

    /**
     * @return string|null
     */
    public function getGroup();

    /**
     * @return string
     */
    public function getLanguage();

    /**
     * @return string
     */
    public function getTranslation();
}