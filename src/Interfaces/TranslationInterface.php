<?php
/**
 * Created by PhpStorm.
 * User: future
 * Date: 05.07.17
 * Time: 21:39
 */

namespace Translator\Interfaces;

/**
 * Interface TranslationInterface
 * @package Translator\Interfaces
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
