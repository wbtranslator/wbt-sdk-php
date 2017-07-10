<?php
/**
 * Created by PhpStorm.
 * User: future
 * Date: 05.07.17
 * Time: 22:05
 */

namespace Translator;

use Translator\Interfaces\CriteriaInterface;

/**
 * Class Criteria
 * @package Translator
 */
class Criteria implements CriteriaInterface
{
    /**
     * @var string
     */
    private $abstractName;

    /**
     * @var string
     */
    private $group;

    /**
     * @var string
     */
    private $language;

    /**
     * Criteria constructor.
     *
     * @param string $language
     * @param string $group
     * @param string $abstractName
     */
    public function __construct($language = null, $group = null, $abstractName = null)
    {
        $this->language = $language;
        $this->group = $group;
        $this->abstractName = $abstractName;
    }

    /**
     * @return string
     */
    public function getAbstractName()
    {
        return $this->abstractName;
    }

    /**
     * @return string
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }
}
