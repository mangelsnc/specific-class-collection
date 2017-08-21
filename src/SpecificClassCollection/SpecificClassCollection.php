<?php

namespace SpecificClassCollection;

use Countable;

abstract class SpecificClassCollection implements Countable
{
    private $collection;

    public function __construct()
    {
        $this->collection = [];
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
    }

    public function getElements()
    {
        return $this->collection;
    }
}