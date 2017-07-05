<?php

namespace Translator;

use Translator\Group\GroupInterface;

/**
 * Class Group
 * @package Translator
 */
class Group implements GroupInterface
{
    /**
     * @var string $name
     */
    protected $name;

    /**
     * Group constructor.
     * @param null $name
     */
    public function __construct($name = null)
    {
        $this->setName($name);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}