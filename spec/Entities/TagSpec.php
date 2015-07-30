<?php

namespace spec\Quincalla\Entities;

use PhpSpec\Laravel\LaravelObjectBehavior;

class TagSpec extends LaravelObjectBehavior
{
    public function it_belongs_to_many_products()
    {
        $this->products()->shouldHaveType('Illuminate\Database\Eloquent\Relations\BelongsToMany');
    }
}
