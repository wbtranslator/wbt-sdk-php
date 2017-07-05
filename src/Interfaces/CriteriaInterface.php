<?php
/**
 * Created by PhpStorm.
 * User: future
 * Date: 05.07.17
 * Time: 21:41
 */

namespace Translator\Interfaces;

/**
 * Interface CriteriaInterface
 * @package Translator\Interfaces
 */
interface CriteriaInterface
{
    /**
     * @return string
     */
    public function getAbstractName();

    /**
     * @return string
     */
    public function getGroup();

    /**
     * @return string
     */
    public function getLanguage();
}
