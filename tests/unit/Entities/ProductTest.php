<?php

use Quincalla\Entities\Product;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_should_return_only_published_products()
    {
        $numOfProducts = 10;
        factory(Quincalla\Entities\Product::class, $numOfProducts)->create([
            'published' => true,
        ]);

        $products = Product::published()->get();

        $this->assertEquals($numOfProducts, $products->count());
    }

    /** @test */
    public function it_should_return_price_as_abs_price()
    {
        factory(Quincalla\Entities\Product::class)->create([
            'price' => '10000',
        ]);

        $product = Product::first();

        $this->assertEquals(100.00, $product->abs_price);
    }

    /** @test */
    public function it_should_return_compare_price_as_abs_price_after_comparing_prices()
    {
        factory(Quincalla\Entities\Product::class)->create([
            'price' => '10000',
            'compare_price' => '9000',
        ]);

        $product = Product::first();

        $this->assertEquals(90.00, $product->abs_price);
    }
}
