<?php

namespace Quincalla\Entities;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model 
{
    protected $table = 'order_products';
    protected $fillable =  [
        'product_id',
        'product_name',
        'attributes',
        'quantity',
        'price',
    ];

    public function order()
    {
        return $this->belongsTo('Quincalla\Entities\Order');
    }
}
