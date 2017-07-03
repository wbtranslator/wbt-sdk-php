<?php

namespace Translator\Group;

/**
 * Interface GroupInterface
 * @package Translator
 */
interface GroupInterface
{
    /**
     * @return string
     */
    public function getName(): string;

   /**
     * @param $name
     * @return self
     */
    public static function create($name);
}