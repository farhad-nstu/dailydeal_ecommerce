<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Shipping;

class ShippingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    
    public function edit($id)
    {
    	$shipping = Shipping::find($id);
    	return view('backend.pages.shipping.create', compact('shipping'));
    }

    public function update(Request $request, $id)
    {
    	$request->validate([
    		'inside_dhaka' => 'required|integer',
    		'outside_dhaka' => 'required|integer',
    	]);


    	$shipping = Shipping::find($id);
    	$shipping->inside_dhaka = $request->inside_dhaka;
    	$shipping->outside_dhaka = $request->outside_dhaka;
    	$shipping->save();

    	session()->flash('success', 'Shipping charge updated successfully');
    	return back();
    }
}
