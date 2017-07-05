<?php

namespace Translator;

/**
 * Class Collection
 * @package Translator
 */
class Collection implements \IteratorAggregate
{
    /**
     * @var array $collections
     */
    public $collections = [];

    /**
     * Collection constructor.
     * @param array $collections
     */
    public function __construct(array $collections = [])
    {
        $this->collections = $collections;
    }

    /**
     * @param $collection
     */
    public function add($collection)
    {
        $this->collections[] = $collection;
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->collections);
    }
}