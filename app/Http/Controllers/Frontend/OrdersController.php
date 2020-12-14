<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Order;
use App\Cart;
use App\Shipping;
use App\City;
use App\Product;
use App\ProductImage;
use Auth;
use DB;
use App\Library\SslCommerz\SslCommerzNotification;
use Session;
use \Shipu\Aamarpay\Aamarpay;
use App\TmpOrder;

class OrdersController extends Controller
{
	public function store(Request $request)
	{
		$request->validate([
			'payment_mentod' => 'required',
			'name' => 'required|max:100',
			'phone_number' => 'required|max:20',
			'shipping_address' => 'required|max:150',

		]);

		global $subtotal;
		$subtotal = Session::get('sub_total');

		$request->validate([
			'phone_number' => 'required',
			'shipping_address' => 'required',
			'name' => 'required'

		]);


		if (Session::has('product') && Session::has('city')) {


			$carts = Session::get('product');

			$total_product = count(array_keys($carts['id']));


			$order_trx_id = uniqid();

			Session::put('transaction_id',$order_trx_id);

			for ($i = 0; $i<=$total_product; $i++) {
				if(isset($carts['id'][$i])):
					$product = Product::find($carts['id'][$i]);

					$order = new Order;

					if (Auth::guard('web')->check()) {
						$order->user_id = Auth::guard('web')->user()->id;
						$order->ip_address = request()->getClientIp();

					}elseif (Auth::guard('vendor')->check()) {
						$order->vendor_id_buy = Auth::guard('vendor')->user()->id;
						$order->ip_address = request()->getClientIp();
					}
					else{

						$order->ip_address = request()->getClientIp();
					}


					$order->name = $request->name;
					$order->phone = $request->phone_number;
					$order->email = $request->email;

					$order->price = $carts['price'][$i];
					$order->shipping_cost = Session::get('shipping');
					$order->amount = Session::get('sub_total');
					if(isset($request->message[$i])):
						$order->message = $request->message[$i];
					endif;
					$order->city_name = Session::get('city');
					$order->shipping_address = $request->shipping_address;
					$order->payment_method = $request->payment_mentod;

					$order->product_id = $carts['id'][$i];



					$order->vendor_id = $product->vendor_id;
					$order->product_title = $product->title;
					if (isset($carts['attribute_options'][$i])) {
						$order->attribute_options = $carts['attribute_options'][$i];
					}

					$order->product_quantity = $carts['quantity'][$i];

					$product_image = ProductImage::where('product_id', $carts['id'][$i])->first();

		  //  	if (!is_null($product_image)) {
		  //  		\File::copy('images/'.$product_image->image, 'images/order/'.$product_image->image);
		  //  		$order->product_image = $product_image->image;
		  //  	}
		  //  	else {
		  //  		$order->product_image = Null;
		  //  	}

					$order_last = Order::orderBy('id', 'desc')->first();

					$order_id_start = 2349345305;

					$order_tracking = $order_id_start + $order_last->id;

					$order->tracking_id = $order_tracking;

					$order->transaction_id = $order_trx_id;

		    	//Payment
					if ($request->payment_mentod == 0) {
						$order->status = "Processing";
						$order->delivery_status = "Processing";
						$order->payment_method = "Cash On Deliver";
					}else {
						$order->status = "Pending";
						$order->payment_method = "Online Payment";
					}

					$order->save();
				endif;
			}

		}else {

			for ($i=0; $i <= $total_product; $i++) {
				if(isset($carts['id'][$i])):
					$product = Product::find($carts['id'][$i]);
					$update_quantity = $product->quantity - $carts['quantity'][$i];
					$product->quantity = $update_quantity;
					$product->save();
				endif;
			}


			Session::forget('product');
			Session::save();

			return redirect()->route('orders.success');

		}


	}


	public function paymentSuccess(Request $request)
	{
		$tmpOrderProducts = TmpOrder::where('tmp_uniq_id', $request->opt_a)->get();

		for ($i = 0; $i<count($tmpOrderProducts); $i++) {

			$tmpOrderProduct = TmpOrder::find($tmpOrderProducts[$i]->id);

			$order = new Order;

			if (Auth::guard('web')->check()) {
				$order->user_id = Auth::guard('web')->user()->id;
				$order->ip_address = $request->ip_address;
			}elseif (Auth::guard('vendor')->check()) {
				$order->vendor_id_buy = Auth::guard('vendor')->user()->id;
				$order->ip_address = $request->ip_address;
			}
			else{
				$order->ip_address = $request->ip_address;
			}

			$order->name = $request->cus_name;
			$order->phone = $request->cus_phone;
			$order->email = $request->cus_email;
			$order->price = $tmpOrderProduct->product_price;
			$order->shipping_cost = $tmpOrderProduct->shipping_cost;
			$order->amount = $request->amount;
			$order->message = $request->desc;
			$order->city_name = $tmpOrderProduct->city_name;
			$order->shipping_address = $request->opt_b;
			$order->payment_method = "online payment";
			$order->product_id = $tmpOrderProduct->product_id;
			$order->product_title = $tmpOrderProduct->product_title;
			$order->product_quantity = $tmpOrderProduct->product_quantity;

			$order_last = Order::orderBy('id', 'desc')->first();

			$order_id_start = 2349345305;

			$order_tracking = $order_id_start + $order_last->id;

			$order->tracking_id = $order_tracking;

			$order->transaction_id = $request->epw_txnid;


			$order->status = $request->pay_status;
			$order->delivery_status = "Processing";

			$order->save();



			$product = Product::find($tmpOrderProduct->product_id);
			$update_quantity = $product->quantity - $tmpOrderProduct->product_quantity;
			$product->quantity = $update_quantity;
			$product->save();

		}
		return redirect()->route('orders.success');

	}

	public function success()
	{
		if (Session::has('transaction_id')) {
			$orders = Order::orderBy('id', 'desc')->where('transaction_id', Session::get('transaction_id'))->get();
			return view('frontend.pages.product.order',compact('orders'));
		}
		else {
			$tmp_uniq_id = Session::get('temp_store_id');
			$tmp_store_products = TmpOrder::where('tmp_uniq_id', $tmp_uniq_id)->get();
			foreach ($tmp_store_products as $tmp_product) {
				$tmp_product->delete();
			}
			Session::forget('product');
			Session::forget('temp_store_id');
			return view('frontend.pages.product.online_pay_success');
		}


	}


    /////aamarpay payment api
	public function amarpayGetwayPayment(Request $request){
        // return $request;exit();

		if($request->get('pay_status') == 'Failed') {
			return redirect()->back();
		}

		$amount = $request->amount;
		$valid  = Aamarpay::valid($request, $amount);

		if($valid) {
            // Successfully Paid.
		} else {
           // Something went wrong.
		}

		return redirect()->back();
	}

	public function paymentFailed(){
		return 'ssd';
	}
}
