<?php

namespace Quincalla\Tests\Functional;

use Quincalla\Tests\TestCase;

class HomePageTest extends TestCase
{
    public function test_it_should_have_site_name()
    {
        $this->visit('/')
            ->see('quincalla');
    }
}
