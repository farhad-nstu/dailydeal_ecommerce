<?php

namespace App\Http\Controllers\Backend\Vendor;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Shop;
use Auth;
use Image;
use File;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:vendor');
    }

    public function shop()
    {
    	return view('backend.vendor.shop');
    }

    public function shopCreate(Request $request)
    {

        $shop_check = Shop::where('vendor_id', Auth::user()->id)->first();
        if (!is_null($shop_check)) {
            session()->flash('You already have shop.');
            return back();
        }
    	$shop = new Shop;
    	$shop->name = $request->name;
    	$shop->vendor_id = Auth::user()->id;

    	if ( isset($request->logo) ) {

            $image = $request->logo;
            //make image name
            $img = time().'l.'.$image->getClientOriginalExtension();
            //image location
            $location = public_path('images/shop/'.$img);

            Image::make($image)->save($location);

            $shop->logo = $img;

            
        
        
    	}

    	if ( isset($request->thumbnail) ) {

            $image = $request->thumbnail;
            //make image name
            $img = time().'t.'.$image->getClientOriginalExtension();
            //image location
            $location = public_path('images/shop/'.$img);

            Image::make($image)->save($location);

            $shop->thumbnail = $img;

            
        
        
    	}

        $shop_unique_id = 15434649;
        $shop->shop_id = $shop_unique_id + $shop->id;
        $shop->phone = $request->phone;
        $shop->email = $request->email;
        $shop->location = $request->location;
        $shop->save();

        session()->flash('success','Shop created successfully.');
        return back();
    }


    public function shopUpdate(Request $request)
    {
    	$shop = Shop::where('vendor_id', Auth::user()->id)->first();
    	

    	if (!is_null($shop)) {
    		$shop->name = $request->name;

	    	if ( isset($request->logo) ) {
	    		if (File::exists('images/shop/'.$shop->logo)) {
                    File::delete('images/shop/'.$shop->logo);
                }

	            $image = $request->logo;
	            //make image name
	            $img = time().'l.'.$image->getClientOriginalExtension();
	            //image location
	            $location = public_path('images/shop/'.$img);

	            Image::make($image)->save($location);

	            $shop->logo = $img;

	            
	        
	        
	    	}

	    	if ( isset($request->thumbnail) ) {

	    		if (File::exists('images/shop/'.$shop->thumbnail)) {
                    File::delete('images/shop/'.$shop->thumbnail);
                }

	            $image = $request->thumbnail;
	            //make image name
	            $img = time().'t.'.$image->getClientOriginalExtension();
	            //image location
	            $location = public_path('images/shop/'.$img);

	            Image::make($image)->save($location);

	            $shop->thumbnail = $img;

	            
	        
	        
	    	}

            $shop->phone = $request->phone;
            $shop->email = $request->email;
            $shop->location = $request->location;

	        $shop->save();

	        session()->flash('success','Updated Successfully');
	        return back();
	    }
	    else {
	    	echo "shop not found";
	    }

    }
}
