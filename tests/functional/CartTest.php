<?php

namespace Quincalla\Tests\Functional;

use Quincalla\Tests\TestCase;
use Quincalla\Tests\Functional\Helpers\ProductTrait;

class CartTest extends TestCase
{
    use ProductTrait;

    protected $productSlug = 'first-necklace-yellow-gold';
    protected $productName = 'First Necklace Yellow Gold';

    public function test_it_should_add_product_to_cart()
    {
        $this->addProductToCart($this->productSlug);
        $this->visit('/cart')
            ->see($this->productName)
            ->click($this->productName)
            ->seePageIs('/products/'.$this->productSlug);
    }

    public function test_it_should_remove_product_from_cart()
    {
        $this->addProductToCart('first-necklace-yellow-gold');
        $this->visit('/cart')
            ->see($this->productName)
            ->click('remove')
            ->see('Your shopping cart is empty.');
    }

    public function test_it_should_empty_shopping_cart()
    {
        $this->addProductToCart($this->productSlug);
        $this->visit('/cart')
            ->see($this->productName)
            ->click('Empty Shopping Cart')
            ->see('Your shopping cart is empty.');
    }

    public function it_should_update_product_quantity()
    {
        $this->addProductToCart($this->productSlug);
        $this->visit('/cart')
            ->see($this->productName)
            ->see('$99')
            ->type(2, 'quantities')
            ->click('Update Cart')
            ->see('$182');
    }
}
