<?php

namespace Translator;

use Translator\Group\GroupInterface;

/**
 * Class Group
 */
class Group implements GroupInterface
{
    protected $name;

    public function __construct($name = null)
    {
        $this->setName($name);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public static function create($name)
    {
    }
}