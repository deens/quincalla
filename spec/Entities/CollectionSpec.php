<?php

namespace spec\Quincalla\Entities;

use PhpSpec\ObjectBehavior;

class CollectionSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Quincalla\Entities\Collection');
    }
}
