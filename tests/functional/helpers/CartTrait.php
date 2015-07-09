<?php
namespace  Quincalla\Tests\Functional\Helpers;

trait CartTrait
{
    public function continueToCheckout()
    {
        $this->visit('/cart')
            ->click('Continue to checkout');
    }
}
