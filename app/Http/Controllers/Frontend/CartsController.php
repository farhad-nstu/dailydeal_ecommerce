<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cart;
use App\Order;
use App\Product;
use App\Shipping;
use Auth;
use Session;
use App\TmpOrder;
 

class CartsController extends Controller
{
	public function index()
	{
	   // dd(Session::get('product'));
		return view('frontend.pages.product.cart');
	}


    public function store(Request $request)
    {
        // dd($request->quantity);
    	$request->validate([
    		'product_id' => 'required',   		
    	]);

    	if (Auth::check()) {
    		
            $request->session()->push('product.id', $request->product_id);
            $request->session()->push('product.originalQty', $request->quantity);
            $request->session()->push('product.quantity', $request->qtybutton);
            $request->session()->push('product.user_id', Auth::user()->id);
            $product = Product::find($request->product_id);
            // var_dump($product->price); exit();
            if (!is_null($product)) {
                if ($product->offer_price > 0) {
                    // dd($product->offer_price);
                    $price = $product->offer_price*$request->qtybutton;
                    $request->session()->push('product.price', $price);
                    $request->session()->push('product.mainprice', $product->offer_price);
                }else {
                    // dd($product->price);
                     $price = $product->price*$request->qtybutton;
                     $request->session()->push('product.price', $price);
                     $request->session()->push('product.mainprice', $product->price);
                }
                
            }else {
                session()->flash('success',"We couldn't find this product.");
                return back();
            }

            if ($request->attribute_options) {
                $attribute_options = serialize($request->attribute_options);
                $request->session()->push('product.attribute_options', $attribute_options);
            }
			

    	}
    	else{

            $request->session()->push('product.id', $request->product_id);
            $request->session()->push('product.originalQty', $request->quantity);
            $request->session()->push('product.quantity', $request->qtybutton);
            $product = Product::find($request->product_id);
            // var_dump($product->price); exit();
            if (!is_null($product)) {
                if ($product->offer_price > 0) {
                    $price = $product->offer_price*$request->qtybutton;
                    $request->session()->push('product.price', $price);
                    $request->session()->push('product.mainprice', $product->offer_price);
                }else {
                     $price = $product->price*$request->qtybutton;
                     $request->session()->push('product.price', $price);
                     $request->session()->push('product.mainprice', $product->price);
                }
                
            }else {
                session()->flash('success',"We couldn't find this product.");
                return back();
            }

            if ($request->attribute_options) {
                $attribute_options = serialize($request->attribute_options);
                $request->session()->push('product.attribute_options', $attribute_options);
            }else {
                $request->session()->push('product.attribute_options', Null);
            }
			
		 
    	}


        return back();


    }


    public function ajaxstore(Request $request)
    {

    	if (Auth::check()) {
    		
            $request->session()->push('product.id', $request->product_id);
            $request->session()->push('product.originalQty', $request->quantity);
            $request->session()->push('product.quantity', $request->qtybutton);
            $request->session()->push('product.user_id', Auth::user()->id);
            $request->session()->push('product.price', $request->price);
            
            // $product = Product::find($request->product_id);
            $request->session()->push('product.mainprice', $request->prc);
            

    	}
    	else{

            $request->session()->push('product.id', $request->product_id);
            $request->session()->push('product.originalQty', $request->quantity);
            $request->session()->push('product.quantity', $request->qtybutton);
            $request->session()->push('product.price', $request->price);
            
            // $product = Product::find($request->product_id);
            // $request->session()->push('product.mainprice', $product->price);
            $request->session()->push('product.mainprice', $request->prc);			
		 
    	}


       return $success = Session::get('product');


    }

    public function updatequantity(Request $request, $id, $action,$dd)
    {
        $carts = Session::get('product');
    //   dd($carts['originalQty'][$id]);
       
        if($carts['quantity'][$id] < $carts['originalQty'][$id]){
            if ($action == "plus") {
           
                $quantity = $carts['quantity'][$id]+1;
    
                $carts['quantity'][$id] = $quantity;
    
                $carts['price'][$id] = $carts['price'][$id] + $carts['mainprice'][$id];
    
                Session::put('product', $carts);
    
                return back();
    		
        	}
        }
    	
    	
    	if ($carts['price'][$id] != 0 && $carts['quantity'][$id] > 1) {
	    	if ($action == "minus") {
                


                $quantity = $carts['quantity'][$id]-1;

                $carts['quantity'][$id] = $quantity;

                $carts['price'][$id] = $carts['price'][$id] - $carts['mainprice'][$id];
                

                Session::put('product', $carts);

                return back();
	    		
	    	}

	    	
	    	
    	}
    	else {
    		return back();
    	}
    	
    	
    }


    public function addShipping($city)
    {
        $shipping = Shipping::find(1);

        if ($city == "Dhaka") {
                if (Session::has('shipping')) {
                    Session::put('shipping', $shipping->inside_dhaka);
                }
                else {
                    Session::put('shipping', $shipping->inside_dhaka);
                }

                Session::put('city', $city);

            }else {
                if (Session::has('shipping')) {
                    Session::put('shipping', $shipping->outside_dhaka);
                }
                else {
                    Session::put('shipping', $shipping->outside_dhaka);
                }

                $city = urldecode($city);
                Session::put('city', $city);
            }            

            return back();
        
    }


    public function temp_order_store()
    {
        $carts = Session::get('product');

        $total_product = count(array_keys($carts['id']));

        $tempStoreId = uniqid();
        Session::put('temp_store_id', $tempStoreId);

        for ($i = 0; $i<$total_product; $i++) {
            $product = Product::find($carts['id'][$i]);                

            $order = new TmpOrder;
            // dd($order);
            
            $order->product_id = $carts['id'][$i];
            
            $order->product_quantity = $carts['quantity'][$i];
            $order->product_title = $product->title;
            $order->product_price = $carts['price'][$i];

            $order->shipping_cost = Session::get('shipping');
            $order->city_name = Session::get('city');
            $order->tmp_uniq_id = $tempStoreId;

            $order->save();
        }

        return response()->json($tempStoreId);
    }


    public function delete($id)
    {
        if (Session::has('product')) {
            $carts = Session::get('product');
            unset($carts['id'][$id]);
            unset($carts['quantity'][$id]);
            unset($carts['price'][$id]);
            unset($carts['attribute_options'][$id]);
            Session::put('product', $carts);
        }
        return back();        
    }



}
