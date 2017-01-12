<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BrowseProductsTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function user_should_see_product_details()
    {
        $product = factory(Quincalla\Entities\Product::class)->create();

        $this->visit('/products/'.$product->slug)
            ->see($product->name);
    }


}
