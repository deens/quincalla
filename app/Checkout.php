<?php

namespace Quincalla;

use Illuminate\Config\Repository;

class Checkout extends Repository
{
    public function __construct()
    {
        $data = [
            'account' => [
                'id' => 1,
                'email' => 'eliurkis@gmail.com'
            ]
        ];

        parent::__construct($data);
    }
}
