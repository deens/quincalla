<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CartManagementTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_should_see_the_cart_empty()
    {
        $this->visit('/cart')
            ->see('Your shopping cart is empty.')
            ->see('Continue Shopping');
    }

    /** @test */
    public function user_should_see_product_after_added_to_cart()
    {
        $product = factory(Quincalla\Entities\Product::class)->create([
            'price' => '9999'
        ]);

        $this->visit('/products/' . $product->slug)
            ->see($product->name)
            ->see('$99.99')
            ->press('Add To Shopping Cart')
            ->see('Product has been added to your shopping cart')
            ->visit('/cart/')
            ->see($product->name)
            ->see('$99.99');
    }

    /** @test */
    public function user_should_be_able_to_add_more_than_one_of_the_same_product()
    {
        $product = factory(Quincalla\Entities\Product::class)->create([
            'price' => 1000,
        ]);

        $this->visit('/products/' . $product->slug)
            ->type(2, 'qty')
            ->press('Add To Shopping Cart')
            ->see('Product has been added to your shopping cart')
            ->visit('/cart')
            ->see($product->name)
            ->see('$10.00')
            ->see('$20.00');
    }

    /** @test */
    public function user_should_be_able_to_remove_product_from_cart()
    {
        $product = factory(Quincalla\Entities\Product::class)->create([
            'price' => 1000,
        ]);

        $this->addProductToCart($product->slug, $product->name, '$10.00')
            ->visit('/cart')
            ->see('$10.00')
            ->click('remove')
            ->seePageIs('/cart')
            ->see('Your shopping cart is empty.');
    }

    /** @test */
    public function user_should_be_able_to_empty_cart()
    {
        $product = factory(Quincalla\Entities\Product::class)->create([
            'price' => 1000,
        ]);

        $this->addProductToCart($product->slug, $product->name, '$10.00')
            ->visit('/cart')
            ->see('$10.00')
            ->click('Empty Shopping Cart')
            ->seePageIs('/cart')
            ->see('Your shopping cart is empty.');
    }

    /** @test */
    public function user_should_be_able_to_add_multiple_products_to_cart()
    {
        $products = factory(Quincalla\Entities\Product::class, 2)->create([
            'price' => 9900,
        ]);
        $first = $products->first();
        $second = $products->last();

        $this->addProductToCart($first->slug, $first->name, '$99.00')
            ->addProductToCart($second->slug, $second->name, '$99.00')
            ->visit('/cart')
            ->see($first->name)
            ->see($second->name)
            ->see('$198.00');
    }

    /** @test */
    public function user_should_be_able_to_change_product_quantity()
    {
        // Change cart product quantity
        // Update cart
        // Check subtotal and total change.
        $this->assertTrue(true);
    }

    protected function addProductToCart($slug, $name, $price)
    {
        return $this->visit('/products/' .$slug)
            ->see($name)
            ->see($price)
            ->press('Add To Shopping Cart')
            ->see('Product has been added to your shopping cart');
    }
}
