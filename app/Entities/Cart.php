<?php 
namespace Quincalla\Entities;

use Gloudemans\Shoppingcart\Cart as PackageCart;

class Cart extends PackageCart
{
    public function __construct()
    {
        parent::__construct(app('session'), app('events'));
    }
}
