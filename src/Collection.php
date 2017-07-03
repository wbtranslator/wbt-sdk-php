<?php

namespace Translator;

use Translator\Collection\CollectionInterface;

class Collection implements CollectionInterface, \IteratorAggregate
{
    public $collections = [];

    public function add($collection)
    {
        $this->collections[] = $collection;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->collections);
    }
}