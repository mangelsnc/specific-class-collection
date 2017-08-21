<?php

namespace SpecificClassCollection;


class InvalidClassException extends \Exception
{
    public function __construct($validClassName)
    {
        $message = sprintf('This object not implements or extends %s', $validClassName);
        parent::__construct($message);
    }
}