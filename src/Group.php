<?php

namespace WebTranslator;

use WebTranslator\Interfaces\GroupInterface;

/**
 * Class Group
 *
 * @package WebTranslator
 */
class Group implements GroupInterface
{
    /**
     * @var string $name
     */
    protected $name;

    /**
     * Group constructor.
     *
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
        return (string) $this->name;
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
