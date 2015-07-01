<?php

namespace Quincalla\Tests\Functional;

use Quincalla\Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{

    public function testProductTitle()
    {
        $this->visit('/products/first-necklace-yellow-gold')
            ->see('First Necklace Yellow Gold');
    }
}

