<?php

namespace Translator\Translator;

use Translator\Collection;
use Translator\Translation;
use Translator\Group\GroupInterface;

/**
 * Interface TranslatorInterface
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
     * @return Collection|Translation[] - Collection of Translation objects
     */
    public function byLanguage($language): Collection;

   /**
     * @param GroupInterface $group
     * @return Collection|Translation[] - Collection of Translation objects
     */
    public function byGroup(GroupInterface $group): Collection;

   /**
     * @return Collection|Translation[] - Collection of Translation objects
     */
    public function all(): Collection;

   /**
     * @param Collection|Translation[] $translations
     * @return bool
     */
    public function send(Collection $translations): bool;
}