<?php

namespace SpecificClassCollection;

use Countable;
use Iterator;

abstract class SpecificClassCollection implements Countable, Iterator
{
    private $collection;
    private $current;

    /**
     * SpecificClassCollection constructor.
     */
    public function __construct()
    {
        $this->collection = [];
        $this->current = 0;
    }

    /**
     * Get the number of elements inside
     * the collection
     *
     * @return int
     */
    public function count()
    {
        return count($this->collection);
    }

    /**
     * Add an element to the collection
     *
     * @param $element
     * @return bool
     * @throws InvalidClassException
     */
    public function add($element)
    {
        $this->checkElementIsValid($element);
        $this->collection[] = $element;

        return true;
    }

    /**
     * Check if an element can be added to
     * the collection
     *
     * @param $element
     * @return bool
     * @throws InvalidClassException
     */
    private function checkElementIsValid($element)
    {
        $elementClass = get_class($element);

        if ($this->getValidClassName() !== $elementClass  && ! is_subclass_of($element, $this->getValidClassName())) {
            throw new InvalidClassException($this->getValidClassName());
        }

        return true;
    }

    /**
     * Get the FQDN of the class we
     * want to store in the collection
     *
     * @return string
     */
    abstract protected function getValidClassName();

    /**
     * Empty the collection
     */
    public function clear()
    {
        $this->collection = [];
        $this->rewind();
    }

    /**
     * Return the array of elements
     *
     * @return array
     */
    public function getElements()
    {
        return $this->collection;
    }

    /**
     * @inheritdoc
     * @return mixed
     */
    public function current()
    {
        return $this->collection[$this->current];
    }

    /**
     * @inheritdoc
     */
    public function next()
    {
        ++$this->current;
    }

    /**
     * @inheritdoc
     * @return int
     */
    public function key()
    {
        return $this->current;
    }

    /**
     * @inheritdoc
     * @return bool
     */
    public function valid()
    {
        return isset($this->collection[$this->current]);
    }

    /**
     * @inheritdoc
     */
    public function rewind()
    {
        $this->current = 0;
    }
}
