<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TmpOrder extends Model
{
    public $fillable = [
        'product_id', 
        'product_quantity', 
        'product_title',
        'product_price',
        'tmp_uniq_id',
        'shipping_cost',
        'city_name'
    ];
}
