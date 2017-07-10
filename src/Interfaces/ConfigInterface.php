<?php
/**
 * Created by PhpStorm.
 * User: future
 * Date: 05.07.17
 * Time: 21:46
 */

namespace Translator\Interfaces;

/**
 * Interface ConfigInterface
 * @package Translator\Interfaces
 */
interface ConfigInterface
{
    /**
     * @return string
     */
    public function getApiUrl();

    /**
     * @return string
     */
    public function getApiKey();
}
