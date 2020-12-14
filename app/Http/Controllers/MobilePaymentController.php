<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\MobilePayment;
use App\Order;

class MobilePaymentController extends Controller
{
    public function store(Request $request)
    {
    	$mobilepayment = new MobilePayment;
    	$mobilepayment->phone_number = $request->phone_number;
    	$mobilepayment->trxid = $request->trxid;
    	$mobilepayment->payment_method = $request->payment_method;
    	$check_order_if_exist = MobilePayment::where('order_id', $request->order_id)->first();

    	if (!is_null($check_order_if_exist)) {
    		session()->flash('success','Payment info already submitted.');
    		return back();
    		exit();
    	}
    	$mobilepayment->order_id = $request->order_id;

    	$mobilepayment->save();

    	session()->flash('success','Payment info submit successfully waiting for verification.');
    	return redirect()->route('index');
    }

    public function manage()
    {
    	$mobilepayments = MobilePayment::orderBy('id','desc')->paginate(20);
    	return view('backend.pages.payment.index',compact('mobilepayments'));
    }

    public function search(Request $request)
    {
        
    	$mobilepayments = MobilePayment::orWhere('phone_number', $request->search)
    		->orWhere('trxid', $request->search)
	    	->orderBy('id', 'desc')->paginate(9);

	    if (is_null($mobilepayments)) {
	    	session()->flash('danger', 'No search result');
	    	return back();
	    }
	    return view('backend.pages.payment.index', compact('mobilepayments'));
    }

    public function update_status($id, $action)
    {
    	$order = Order::find($id);
    	$order->is_paid = $action;
    	$order->save();
    	return back();
    }

    public function delete($id)
    {
    	$order = MobilePayment::find($id);
    	
    	if (!is_null($order)) {
    		$order->delete();
    		session()->flash('success', 'Order deleted successfully');
    	 	return back();
    	}

    	return back();
    	 

    	 
    }
}
