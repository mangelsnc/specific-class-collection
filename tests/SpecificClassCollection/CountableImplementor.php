<?php

namespace Tests\SpecificClassCollection;

use SpecificClassCollection\SpecificClassCollection;

class CountableImplementor implements \Countable
{
    public function count()
    {
        return 1;
    }
}
