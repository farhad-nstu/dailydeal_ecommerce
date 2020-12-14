<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $fillable = [
        'user_id', 
        'ip_address', 
        'name',
        'phone_number',
        'email',
        'shipping_address',
        'delivery_address',
        'message',
        'status',
        'is_completed',
        'is_paid',
        'city_id'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function carts()
    {
    	return $this->belongsTo(Cart::class);
    }

    public function cities()
    {
        return $this->belongsTo(City::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
