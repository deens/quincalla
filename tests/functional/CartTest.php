<?php
namespace Quincalla\Tests\Functional;

use Quincalla\Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Quincalla\Tests\Functional\Helpers\ProductTrait;

class CartTest extends TestCase
{
    use ProductTrait;

    public function testAddProductToCart()
    {
        $productName = 'First Necklace Yellow Gold';

        $this->addProductToCart('first-necklace-yellow-gold');
        $this->visit('/cart')
            ->see($productName)
            ->click($productName)
            ->seePageIs('/products/first-necklace-yellow-gold');
    }

    public function testRemoveProductFromCart()
    {
        $productName = 'First Necklace Yellow Gold';

        $this->addProductToCart('first-necklace-yellow-gold');
        $this->visit('/cart')
            ->see($productName)
            ->click('remove')
            ->see('Your shopping cart is empty.');
    }

}
