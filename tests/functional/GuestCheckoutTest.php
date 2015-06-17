<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GuestCheckoutTest extends TestCase
{
    use DatabaseTransactions;

    public function testGuestCheckout()
    {
        $this->visit('/products/first-necklace-yellow-gold')
            ->press('Add To Shopping Cart')

            ->seePageIs('/cart')
            ->click('Continue to checkout')

            ->seePageIs('/checkout/customer')
            ->see('New Customer')
            ->select('guest', 'account_type')
            ->press('Continue')

            ->seePageIs('/checkout/shipping')
            ->type('Johnny', 'first_name')
            ->type('Curley', 'last_name')
            ->type('johnnyc@example.com', 'account_email')
            ->type('1 First St.', 'address')
            ->type('Apt. 234', 'address1')
            ->type('San Francisco', 'city')
            ->select('1', 'state')
            ->type('94109', 'zipcode')
            ->type('4152345678', 'phone')
            ->press('Continue to payment')

            ->seePageIs('/checkout/billing')
            ->type('Johnny Curley', 'name_on_card')
            ->type('4242424242424242', 'card_number')
            ->select('1', 'card_type')
            ->type('123', 'ccv_code')
            ->press('Continue to confirm')

            ->seePageIs('/checkout/confirm');
    }
}

