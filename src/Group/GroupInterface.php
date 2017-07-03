<?php

namespace Translator\Group;

/**
 * Interface GroupInterface
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