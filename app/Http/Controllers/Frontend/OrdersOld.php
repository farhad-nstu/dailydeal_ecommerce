<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Order;
use App\Cart;
use App\Shipping;
use App\City;
use App\Product;
use Auth;

class OrdersController extends Controller
{
    public function store(Request $request)
    {
    	$cities = City::orderBy('priority', 'asc')->get();
		$shippingcharge = Shipping::find(1);

		$carts = new Cart;
		$carts = $carts->carts();

		foreach ($carts as $cart_id) {
			$cart_find = Cart::find($cart_id->id);
			$cart_find->status = 1;
			$cart_find->save();

			$product = Product::find($cart_find->product_id);
			$update_quantity = $product->quantity - $cart_find->product_quantity;
			$product->quantity = $update_quantity;
			$product->save();
			
		}

		$order = new Order;

		$total_price = 0;
                                    
        foreach($carts as $cart) {

            $total_price += $cart->price;
        }

		if (Auth::check()) {
			$order->user_id = Auth::user()->id;
			$order->ip_address = request()->getClientIp();
			$order->name = Auth::user()->name;
			$order->phone = Auth::user()->phone_number;

    	}
    	else{

			$order->ip_address = request()->getClientIp();
			$order->name = $request->name;
			$order->phone = $request->phone_number;
    	}


    	if ($request->city_name == 'Dhaka' ) {

			$total_price = $total_price + $shippingcharge->inside_dhaka;
		}
		else {
			$total_price = $total_price + $shippingcharge->outside_dhaka;
		}

		$order->amount = $total_price;
		$order->message = $request->message;
    	$order->city_name = $request->city_name;
    	$order->shipping_address = $request->shipping_address;
    	$order->payment_method = $request->payment_mentod;
    	$order->tracking_id = Str::random(13);

    	foreach ($carts as $cart) {
    		$carts_id[] = $cart->id;   		
    	}

    	$serialize = serialize($carts_id);

    	$order->carts_id = $serialize;

    	$order->save();

    	
    	return redirect()->route('orders.success');

    	/*$last_order_id = Order::orderBy('id', 'desc')->first();

    	echo $last_order_id->id;

    	$carts->order_id = $order->id;*/


	}

	public function success()
	{
		if (Auth::check()) {
    		$order_last = Order::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->first();
    	}
    	else {
    		$order_last = Order::orderBy('id', 'desc')->where('ip_address', request()->getClientIp())->first();
    	}

    	return view('frontend.pages.product.order',compact('order_last'));

	}
}
