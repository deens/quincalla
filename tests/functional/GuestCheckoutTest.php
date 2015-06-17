<?php

namespace Quincalla\Tests\Functional;

use Quincalla\Tests\TestCase;
use Quincalla\Tests\Functional\Helpers\CheckoutAuthTrait;
use Quincalla\Tests\Functional\Helpers\CartTrait;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GuestCheckoutTest extends TestCase
{
    use DatabaseTransactions;
    use CheckoutAuthTrait;
    use CartTrait;

    public function testGuestCheckout()
    {
        $this->addProductToCart();

        $this->continueToCheckout();

        $this->continueAsGuest();

        $this->fillShippingAddress();

        $this->seePageIs('/checkout/billing')
            ->type('Johnny Curley', 'name_on_card')
            ->type('4242424242424242', 'card_number')
            ->select('1', 'card_type')
            ->type('123', 'ccv_code')
            ->press('Continue to confirm')

            ->seePageIs('/checkout/confirm');
    }

    private function addProductToCart()
    {
        return $this->visit('/products/first-necklace-yellow-gold')
            ->press('Add To Shopping Cart');
    }

    private function selectContinueAsGuest()
    {
        return $this->seePageIs('/checkout/customer')
            ->see('New Customer')
            ->select('guest', 'account_type')
            ->press('Continue');
    }
}

