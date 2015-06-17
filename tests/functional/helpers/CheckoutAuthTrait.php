<?php

namespace Quincalla\Tests\Functional\Helpers;

trait CheckoutAuthTrait
{
    public function continueAsGuest()
    {
        return $this->seePageIs('/checkout/customer')
            ->see('New Customer')
            ->select('guest', 'account_type')
            ->press('Continue');
    }

    public function fillShippingAddress()
    {
        $this->seePageIs('/checkout/shipping')
            ->type('Johnny', 'first_name')
            ->type('Curley', 'last_name')
            ->type('johnnyc@example.com', 'account_email')
            ->type('1 First St.', 'address')
            ->type('Apt. 234', 'address1')
            ->type('San Francisco', 'city')
            ->select('1', 'state')
            ->type('94109', 'zipcode')
            ->type('4152345678', 'phone')
            ->press('Continue to payment');
    }

    public function fillPaymentAndContinue()
    {
        return $this->seePageIs('/checkout/billing')
            ->type('Johnny Curley', 'name_on_card')
            ->type('4242424242424242', 'card_number')
            ->select('1', 'card_type')
            ->type('123', 'ccv_code')
            ->press('Continue to confirm');
    }
}
