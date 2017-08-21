<?php

namespace SpecificClassCollection;

use Countable;
use Iterator;

abstract class SpecificClassCollection implements Countable, Iterator
{
    private $collection;
    private $current;

    public function __construct()
    {
        $this->collection = [];
        $this->current = 0;
    }

    public function count()
    {
        return count($this->collection);
    }

    public function add($element)
    {
        $this->checkElementIsValid($element);
        $this->collection[] = $element;

        return true;
    }

    private function checkElementIsValid($element)
    {
        $elementClass = get_class($element);

        if ($this->getValidClassName() !== $elementClass) {
            throw new InvalidClassException($this->getValidClassName());
        }

        return true;
    }

    abstract protected function getValidClassName();

    public function clear()
    {
        $this->collection = [];
        $this->rewind();
    }

    public function getElements()
    {
        return $this->collection;
    }

    public function current()
    {
        return $this->collection[$this->current];
    }

    public function next()
    {
        ++$this->current;
    }

    public function key()
    {
        return $this->current;
    }

    public function valid()
    {
        return isset($this->collection[$this->current]);
    }

    public function rewind()
    {
        $this->current = 0;
    }
}