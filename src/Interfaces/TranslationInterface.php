<?php
declare(strict_types=1);

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
     * @return GroupInterface
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
