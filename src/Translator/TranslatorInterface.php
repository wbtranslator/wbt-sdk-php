<?php

namespace Translator\Translator;

use Translator\Collection\CollectionInterface;
use Translator\Group\GroupInterface;
use Translator\Translation;

/**
 * Interface TranslatorInterface
 *
 * @package Translator
 */
interface TranslatorInterface
{
    /**
     * @param $abstractName
     * @param $language
     * @param GroupInterface|null $group
     * @return string
     */
    public function one($abstractName, $language, GroupInterface $group = null): string;

   /**
     * @param string $language
     * @return CollectionInterface|Translation[] - CollectionInterface of Translation objects
     */
    public function byLanguage($language): CollectionInterface;

   /**
     * @param GroupInterface $group
     * @return CollectionInterface|Translation[] - CollectionInterface of Translation objects
     */
    public function byGroup(GroupInterface $group): CollectionInterface;

   /**
     * @return CollectionInterface|Translation[] - CollectionInterface of Translation objects
     */
    public function all(): CollectionInterface;

   /**
     * @param CollectionInterface|Translation[] $translations
     * @return bool
     */
    public function send(CollectionInterface $translations);
}