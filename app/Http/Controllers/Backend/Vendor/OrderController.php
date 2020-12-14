<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Cart;
use Auth;


class OrderController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:vendor');
    }



    public function manage()
    {
    	$orders = Order::orderBy('id','desc')->where('vendor_id',Auth::user()->id)->paginate(20);

    
    	return view('backend.vendor.order',compact('orders'));
    }

    public function search(Request $request)
    {
        if (!is_null($request->status)) {
            $orders = Order::where('status', $request->status)->paginate(9);
        }
        else{
    	$orders = Order::orWhere('phone_number', $request->search)
    		->orWhere('tracking_id', $request->search)
	    	->orWhere('name', 'like','%'.$request->search.'%')
	    	->orderBy('id', 'desc')->paginate(9);
        }

	    if (is_null($orders)) {
	    	session()->flash('danger', 'No search result');
	    	return back();
	    }
	    return view('backend.pages.order.index', compact('orders'));
    }

    public function update_status($id, $action)
    {
    	$order = Order::where('id',$id)->where('vendor_id',Auth::user()->id)->first();
        if (!is_null($order)) {

            if ($action == 'Processing' or $action == 'Out for Delivery') {
                $order->delivery_status = $action;
                $order->save();
                session()->flash("success","Order updated.");
            }else {
                session()->flash("danger","You don't have permission for this");
                return back();
            }
        }

        else {
            session()->flash("danger","Order not found");
        }

        return back();
    }

    public function update_courier(Request $request,$id)
    {
        $order = Order::where('id',$id)->where('vendor_id',Auth::user()->id)->first();
        if (!is_null($order)) {          
            $order->courier_info = $request->courier_info;
            $order->save();
            session()->flash("success","Order updated.");
            
        }

        else {
            session()->flash("danger","Order not found");
        }

        return back();
    }

    public function delete($id)
    {
    	$order = Order::find($id);
    	$carts = unserialize($order->carts_id);
    	foreach ($carts as $cart) {
    	 	$carts_find = Cart::find($cart);
            if (!is_null($carts_find)) {
                $carts_find->delete();
            }
    	 	
    	 } 

    	 $order->delete();

    	 session()->flash('success', 'Order deleted successfully');
    	 return back();
    }
}
