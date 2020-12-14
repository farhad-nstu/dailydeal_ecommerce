<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use App\Order;


class AdminPagesController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
    	return view('admin.pages.index');
    }
    
    public function marketing()
    {
        $users = User::orderBy('id','desc')->paginate(50);
       return view('backend.pages.marketing.index',compact('users'));
    }

    public function userSearch(Request $request)
    {
        $users = User::orWhere('name', 'like','%'.$request->search.'%')->orWhere('email', 'like','%'.$request->search.'%')->orWhere('phone_number', 'like','%'.$request->search.'%')->paginate(50);
        return view('backend.pages.marketing.index',compact('users'));
    }

    public function areaSearch(Request $request)
    {
        $search = $request->search;

        $users = User::orWhere('address', 'like','%'.$request->search.'%')->orWhere('delivery_address', 'like','%'.$request->search.'%')->orWhere('city_id', 'like','%'.$request->search.'%')->paginate(50);
        return view('backend.pages.marketing.index',compact('users','search'));
    }

    public function byProductSearch(Request $request)
    {
        $search = $request->search;

        $orders = Order::orWhere('product_title', 'like','%'.$request->search.'%')->orWhere('city_name', 'like','%'.$request->search.'%')->groupBy('phone')->paginate(50);
        return view('backend.pages.marketing.index',compact('orders','search'));
    }

}
