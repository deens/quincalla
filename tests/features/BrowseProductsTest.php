<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BrowseProductsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_should_see_product_details_on_product_page()
    {
        $product = factory(Quincalla\Entities\Product::class)->create();

        $this->visit('/products/'.$product->slug)
            ->see($product->name)
            ->see($product->description);
    }

    /** @test */
    public function user_should_not_see_product_details_on_unpublished()
    {
        $product = factory(Quincalla\Entities\Product::class)->create([
            'published' => false,
        ]);

        $response = $this->call('GET', '/products/'. $product->slug);

        $this->assertEquals(404, $response->status());
    }

    /** @test */
    public function user_should_see_product_price()
    {
        $product = factory(Quincalla\Entities\Product::class)->create([
            'price' => '9000'
        ]);

        $this->visit('/products/'.$product->slug)
            ->see($product->name)
            ->see('$90.00');
    }

    /** @test */
    public function user_should_see_product_price_and_compare_price()
    {
        $product = factory(Quincalla\Entities\Product::class)->create([
            'price' => 9000,
            'compare_price' => 7999,
        ]);

        $this->visit('/products/'.$product->slug)
            ->see($product->name)
            ->see('$79.99')
            ->see('$90.00');
    }
}
