<?php

namespace Tests\SpecificClassCollection;

use SpecificClassCollection\SpecificClassCollection;

class DateTimeCollection extends SpecificClassCollection
{

    protected function getValidClassName()
    {
        return \DateTime::class;
    }
}