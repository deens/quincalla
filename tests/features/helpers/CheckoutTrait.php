<?php

trait CheckoutTrait
{
    public function continueAsCustomer($email, $password)
    {
        return $this->seePageIs('/order/customer')
            ->type($email, 'email')
            ->type($password, 'password')
            ->press('Sign in to checkout');
    }

    public function continueAsNewCustomer()
    {
        return $this->seePageIs('/order/customer')
            ->click('Continue as New Customer');
    }

    public function fillRegisterCustomerWith($name = '', $email = '', $password = '', $passwordConfirm = '')
    {
        return $this->seePageIs('/order/register')
            ->type($name, 'name')
            ->type($email, 'email')
            ->type($password, 'password')
            ->type($passwordConfirm, 'password_confirmation')
            ->press('Continue to Delivery');
    }

    public function fillDeliveryWith($address = [], $shipping = 'free_shipping')
    {
        return $this->seePageIs('/order/delivery')
            ->type($address['name'], 'name')
            ->type($address['address'], 'address')
            ->type($address['address1'], 'address1')
            ->type($address['city'], 'city')
            ->select($address['state'], 'state')
            ->select($address['country'], 'country')
            ->type($address['zipcode'], 'zipcode')
            ->type($address['phone'], 'phone')
            ->select($shipping, 'shipping_method')
            ->press('Continue to payment');
    }

    public function fillPaymentWith($payment = [])
    {
        return $this->seePageIs('/order/payment')
            ->type($payment['card_number'], 'card_number')
            ->select($payment['exp_month'], 'exp-month')
            ->type($payment['exp_year'], 'exp-year')
            ->type($payment['cvc'], 'cvc')
            ->press('Continue to confirmation');
    }
}
