<?php

namespace App\Http\Controllers\Userprofile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Order;
use App\Transaction;
use Auth;


class MyaccountsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }


    public function show()
    {
    	return view('frontend.pages.user.myaccounts');
    }

    public function profileupdate(Request $request)
    {
        if(!empty($request->password)) {
    	 $request->validate([
            'name' => 'string|max:255',
            'password' => 'string|min:8|confirmed',
            'phone_number' => 'string|max:15',
            'address' => 'max:150',
            
        ]);
        }else {
            $request->validate([
            'name' => 'string|max:255',
            'phone_number' => 'string|max:15',
            'address' => 'max:150',
            
        ]);
        }

    	$user = User::find(Auth::user()->id);


    	if (!empty($request->name)) {
    		$user->name = $request->name;
    	}

    	if (!empty($request->phone_number)) {
    		$user->phone_number = $request->phone_number;
    	}

    	if (!empty($request->address)) {
    		$user->address = $request->address;
    	}

    	if (!empty($request->delivery_address)) {
    		$user->delivery_address = $request->delivery_address;
    	}

    	if (!empty($request->delivery_phone)) {
    		$user->delivery_phone = $request->delivery_phone;
    	}
    	if (!empty($request->gender)) {
    		$user->gender = $request->gender;
    	}
    	if (!empty($request->city_id)) {
    		$user->city_id = $request->city_id;
    	}
    	if (!empty($request->old_password) && !empty($request->password)) {

    		$new_password = Hash::make($request->password);


    		if (Hash::check($request->old_password, $user->password)) {
    			$user->password = $new_password;
    		}
    		else {
    			session()->flash('danger',"Old password don't match ");
    			return back();
    			exit();
    		}
    		
    	}

    	$user->save();

    	session()->flash('success',"Profile update successfully.");
    	return back();


    }

    public function orders()
    {
        if (Auth::check()) {
            $orders = Order::where('user_id',Auth::user()->id)->paginate(20);
            return view('frontend.pages.user.order', compact('orders'));
        }else {

        }
    }

    public function orderaction($id, $action)
    {
        $order = Order::where('user_id',Auth::user()->id)->where('id', $id)->first();
        if (!is_null($order)) {
            if ($action == "Cancle") {
                $order->delivery_status = "Cancle Waiting For Confirmation";
                $order->save();
                session()->flash('success', 'Success! Thanks for stay with us.');
                return back();
            }elseif($action == "Delivered"){
                $transaction = new Transaction;
                $transaction_id = '10'.uniqid();
                $transaction->transaction_id = $transaction_id;
                $transaction->vendor_id = $order->vendor_id;
                $transaction->product_title = $order->product_title;
                $transaction->product_quantity = $order->product_quantity;
                $transaction->payment_method = $order->payment_method;
                $transaction->product_price = $order->price;
                $comission = $order->price*(10/100);
                $transaction->comission = $comission;
                $transaction->balance = $order->price - $comission;
                $transaction->shipping_cost = $order->shipping_cost;
                $transaction->total = $order->amount;
                $transaction->status = "Waiting For Clearance";
                $transaction->withdraw = "Not Withdraw Yet";

                $transaction->save();

                $order->delivery_status = "Delivered";
                $order->save();
                session()->flash('success', 'Success! Thanks for stay with us.');
                return back();
            }
            
        }else {
            session()->flash('danger', "This order doesn's exists.");
            return back();
        }
        
    }

    public function ordersearch(Request $request)
    {
        if (!is_null($request->status)) {
            $orders = Order::where('status', $request->status)->where('user_id', Auth::user()->id)->paginate(9);
        }
        else {
            $orders = Order::orWhere('phone', $request->search)
            ->orWhere('tracking_id', $request->search)
            ->orWhere('name', 'like','%'.$request->search.'%')
            ->orderBy('id', 'desc')->where('user_id', Auth::user()->id)->paginate(9);
        }

        return view('frontend.pages.user.order', compact('orders'));
    }

    public function otpactivation(Request $request)
    {
        $request->validate([
            'otp' => 'required|min:3|max:4',
            
        ]);

        $user = User::find(Auth::user()->id);
        if (!is_null($user)) {
            if ($user->otp === $request->otp) {
               $user->status = 1;
               $user->otp = null;
               $user->save();
               session()->flash('success', 'Account activated successfully.');
                return back();
            }
        }
    }


}
