<?php

namespace spec\Quincalla\Entities;

use PhpSpec\ObjectBehavior;

class StateSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Quincalla\Entities\State');
    }
}
