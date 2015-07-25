<?php

namespace Quincalla\Tests\Functional;

use Quincalla\Tests\TestCase;

class ProductTest extends TestCase
{
    public function test_it_should_have_product_name_as_title()
    {
        $this->visit('/products/first-necklace-yellow-gold')
            ->see('First Necklace Yellow Gold');
    }
}
