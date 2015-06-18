<?php

namespace Quincalla\Tests\Functional\Helpers;

trait CheckoutTrait
{
    public function continueAsGuest()
    {
        return $this->seePageIs('/checkout/customer')
            ->see('New Customer')
            ->select('guest', 'account_type')
            ->press('Continue');
    }

    public function fillShippingAddress($data = [])
    {
        return $this->seePageIs('/checkout/shipping')
            ->type($data['first_name'], 'first_name')
            ->type($data['last_name'], 'last_name')
            ->type($data['email'], 'account_email')
            ->type($data['address'], 'address')
            ->type($data['address1'], 'address1')
            ->type($data['city'], 'city')
            ->select($data['state'], 'state')
            ->type($data['zipcode'], 'zipcode')
            ->type($data['phone'], 'phone')
            ->press('Continue to payment');
    }

    public function fillPaymentAndContinue($data = [])
    {
        return $this->seePageIs('/checkout/billing')
            ->type($data['name_on_card'], 'name_on_card')
            ->type($data['card_number'], 'card_number')
            ->select($data['card_type'], 'card_type')
            ->type($data['ccv_code'], 'ccv_code')
            ->press('Continue to confirm');
    }
}
