<?php

namespace Quincalla\Tests\Functional\Helpers;

trait CheckoutTrait
{
    public function continueAsGuest()
    {
        $this->seePageIs('/checkout/customer')
            ->see('New Customer')
            ->select('guest', 'account_type')
            ->press('Continue');
    }

    public function continueAsNewCustomer()
    {
        $this->seePageIs('/checkout/customer')
            ->see('New Customer')
            ->select('new', 'account_type')
            ->press('Continue');
    }

    public function fillShippingAddressWith(
        $address = [],
        $email = null,
        $password = null,
        $passwordConfirm = null)
    {
        $this->seePageIs('/checkout/shipping');

        if ($email) {
            $this->type($email, 'account_email');
        }

        if ($password && $passwordConfirm) {
            $this->type($password, 'password');
            $this->type($passwordConfirm, 'password_confirmation');
        }

        $this->type($address['first_name'], 'first_name')
            ->type($address['last_name'], 'last_name')
            ->type($address['address'], 'address')
            ->type($address['address1'], 'address1')
            ->type($address['city'], 'city')
            ->select($address['state'], 'state')
            ->type($address['zipcode'], 'zipcode')
            ->type($address['phone'], 'phone');

         $this->press('Continue to payment');
    }

    public function fillPaymentAndContinue($payment = [])
    {
        $this->seePageIs('/checkout/billing')
            ->type($payment['name_on_card'], 'name_on_card')
            ->type($payment['card_number'], 'card_number')
            ->select($payment['card_type'], 'card_type')
            ->type($payment['ccv_code'], 'ccv_code')
            ->press('Continue to confirm');
    }
}
