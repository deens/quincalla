<?php
namespace Quincalla\Tests\Functional\Helpers;

trait ProductTrait
{
    public function addProductToCart($slug)
    {
        $this->visit('/products/' . $slug)
            ->press('Add To Shopping Cart');
    }
}
