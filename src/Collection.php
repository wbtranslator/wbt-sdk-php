<?php

namespace Translator;

class Collection implements \IteratorAggregate
{
    public $collections = [];

    public function __construct(array $collections = [])
    {
        $this->collections = $collections;
    }

    public function add($collection)
    {
        $this->collections[] = $collection;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->collections);
    }
}