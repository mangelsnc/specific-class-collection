<?php

namespace Tests\SpecificClassCollection;

use SpecificClassCollection\SpecificClassCollection;

class CountableCollection extends SpecificClassCollection
{
    protected function getValidClassName()
    {
        return \Countable::class;
    }


}
