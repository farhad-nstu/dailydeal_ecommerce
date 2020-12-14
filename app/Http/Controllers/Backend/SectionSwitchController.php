<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\SectionSwitch;

class SectionSwitchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    
    public function featuredSwitch(Request $request)
    {
    	$featured = SectionSwitch::find(1);
    	if (isset($request->featured_home)) {
    			$featured->action = 1;
    			$featured->save();
    	}

    	else {
    			$featured->action = 0;
    			$featured->save();
    	}
    	session()->flash('success', 'Option Save Successfully.');
    	return back();
    	
    }


    public function shopAndSave(Request $request)
    {
    	$shop_save = SectionSwitch::find(4);

    	if (isset($request->shop_save)) {
    			$shop_save->action = 1;
    			$shop_save->save();
    	}

    	else {
    			$shop_save->action = 0;
    			$shop_save->save();
    	}

    	session()->flash('success', 'Option Save Successfully.');
    	return back();
    	
    }

    public function homeCategory(Request $request)
    {
    	$home_category = SectionSwitch::find(5);

    	if (isset($request->home_category)) {
    			$home_category->action = 1;
    			$home_category->save();
    	}

    	else {
    			$home_category->action = 0;
    			$home_category->save();
    	}

    	session()->flash('success', 'Option Save Successfully.');
    	return back();
    	
    }

    public function popularProduct(Request $request)
    {
    	$home_popular_product = SectionSwitch::find(6);

    	if (isset($request->home_popular_product)) {
    			$home_popular_product->action = 1;
    			$home_popular_product->save();
    	}

    	else {
    			$home_popular_product->action = 0;
    			$home_popular_product->save();
    	}

    	session()->flash('success', 'Option Save Successfully.');
    	return back();
    	
    }


    public function homeSlider(Request $request)
    {
    	$home_slider = SectionSwitch::find(7);

    	if (isset($request->home_slider)) {
    			$home_slider->action = 1;
    			$home_slider->save();
    	}

    	else {
    			$home_slider->action = 0;
    			$home_slider->save();
    	}

    	session()->flash('success', 'Option Save Successfully.');
    	return back();
    	
    }


    public function homeTestimonial(Request $request)
    {
    	$home_testimonial = SectionSwitch::find(8);

    	if (isset($request->home_testimonial)) {
    			$home_testimonial->action = 1;
    			$home_testimonial->save();
    	}

    	else {
    			$home_testimonial->action = 0;
    			$home_testimonial->save();
    	}

    	session()->flash('success', 'Option Save Successfully.');
    	return back();
    	
    }


    public function homePaymentbanner(Request $request)
    {
    	$home_paymentbanner = SectionSwitch::find(9);

    	if (isset($request->home_paymentbanner)) {
    			$home_paymentbanner->action = 1;
    			$home_paymentbanner->save();
    	}

    	else {
    			$home_paymentbanner->action = 0;
    			$home_paymentbanner->save();
    	}

    	session()->flash('success', 'Option Save Successfully.');
    	return back();
    	
    }


    


    public function homeCounter(Request $request)
    {
    	$home_counter = SectionSwitch::find(10);

    	if (isset($request->home_counter)) {
    			$home_counter->action = 1;
    			$home_counter->save();
    	}

    	else {
    			$home_counter->action = 0;
    			$home_counter->save();
    	}

    	session()->flash('success', 'Option Save Successfully.');
    	return back();
    	
    }

}
