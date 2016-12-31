<?php

namespace Quincalla\Tests\Functional\Helpers;

trait ProductTrait
{
    public function addProductToCart($slug)
    {
        return $this->visit('/products/'.$slug)
            ->press('Add To Shopping Cart');
    }
}
