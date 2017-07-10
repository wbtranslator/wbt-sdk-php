<?php

namespace WebTranslator\Interfaces;

/**
 * Interface TranslationInterface
 *
 * @package WebTranslator
 */
interface TranslationInterface
{
    /**
     * @return string
     */
    public function getAbstractName(): string;

    /**
     * @return GroupInterface|null
     */
    public function getGroup(): GroupInterface;

    /**
     * @return string
     */
    public function getLanguage(): string;

    /**
     * @return string
     */
    public function getTranslation(): string;
}