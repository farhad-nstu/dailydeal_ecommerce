<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Counter;

class CounterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    
    public function Update(Request $request)
    {
    	$counter = Counter::find(1);
    	$counter->exclusive_categories = $request->exclusive_categories;
    	$counter->products_accessories = $request->products_accessories;
    	$counter->happy_customer = $request->happy_customer;

    	$counter->save();

    	session()->flash('success', 'Counter updated successfully');
    	return back();
    }


    public function automatic(Request $request)
    {
    	$automatic_counter = Counter::find(1);

    	if (isset($request->automatic_counter)) {
    			$automatic_counter->automatic = 1;
    			$automatic_counter->save();
    	}

    	else {
    			$automatic_counter->automatic = 0;
    			$automatic_counter->save();
    	}
    	session()->flash('success', 'Option Save Successfully.');
    	return back();
    }
}
