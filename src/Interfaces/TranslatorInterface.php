<?php
/**
 * Created by PhpStorm.
 * User: future
 * Date: 05.07.17
 * Time: 21:41
 */

namespace Translator\Interfaces;

use Doctrine\Common\Collections\Collection;

/**
 * Interface TranslatorInterface
 * @package Translator\Interfaces
 */
interface TranslatorInterface
{
    /**
     * @param CriteriaInterface|null $criteria
     * @return Collection
     */
    public function byCriteria(CriteriaInterface $criteria = null);

    /**
     * @param string $language
     * @return Collection|TranslationInterface[]
     */
    public function byLanguage($language);

    /**
     * @param string $group
     * @return Collection|TranslationInterface[]
     */
    public function byGroup($group);

    /**
     * @param string $abstractName
     * @param string $language
     * @param string $group
     * @return string|null
     */
    public function one($abstractName, $language, $group);

    /**
     * @return Collection|TranslationInterface[]
     */
    public function all();
}
