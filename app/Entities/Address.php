<?php

namespace Quincalla\Entities;

class Address
{
    protected static $fields = [
        'name',
        'address',
        'address1',
        'city',
        'state',
        'country',
        'phone',
        'zipcode',
    ];

    public static function getFields()
    {
        return self::$fields;
    }

    public function __get($name)
    {
        return isset(self::$fields[$name]) ? self::$fields[$name] : '';
    }

    public function __set($name, $value)
    {
        self::$fields[$name] = $value;
    }
}
