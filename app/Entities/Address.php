<?php

namespace Quincalla\Entities;

class Address
{
    protected $fields = [
        'first_name',
        'last_name',
        'address',
        'address1',
        'city',
        'state',
        'country',
        'phone',
        'zipcode',
    ];

    public function getFields()
    {
        return $this->fields;
    }
}
