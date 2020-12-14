<?php

namespace App;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Session;

class Cart extends Model
{
    public $fillable = [
        'user_id', 
        'product_id', 
        'order_id',
        'product_quantity',
        
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
    public function order()
    {
    	return $this->belongsTo(Order::class);
    }

    public function carts()
    {
       if (Auth::check()) {
        Session::push('product.user_id', Auth::user()->id);
        }
        
    }
    
}
