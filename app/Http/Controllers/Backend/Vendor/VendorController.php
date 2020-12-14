<?php

namespace App\Http\Controllers\Backend\Vendor;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Vendor;
use Image;
use File;
use Illuminate\Support\Facades\Hash;
use Auth;

class VendorController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:vendor');
    }

    public function home()
    {
    	return view('backend.vendor.index');
    }

    public function profile()
    {
    	return view('backend.vendor.profile');
    }

    public function profileUpdate(Request $request)
    {
    	$vendor = Vendor::find(Auth::user()->id);
    	if (!is_null($vendor)) {
    		$vendor->name = $request->name;
    		$vendor->email = $request->email;
    		$vendor->phone = $request->phone;
    		$vendor->address = $request->address;

    		if ( isset($request->image) ) {

                if (File::exists('images/vendor/'.$vendor->image)) {
                    File::delete('images/vendor/'.$vendor->image);
                }

                $image = $request->image;
                //make image name
                $img = time().'.'.$image->getClientOriginalExtension();
                //image location
                $location = public_path('images/vendor/'.$img);

                Image::make($image)->save($location);

                $vendor->image = $img;

                $vendor->save();
            
            
        	}

        	if (!empty($request->old_password) && !empty($request->password)) {

	            $new_password = Hash::make($request->password);


	            if (Hash::check($request->old_password, $vendor->password)) {
	                $vendor->password = $new_password;
	            }
	            else {
	                session()->flash('danger',"Old password don't match ");
	                return back();
	                exit();
	            }
            
        	}

        	$vendor->save();

        	session()->flash('success', 'Profile update successfully.');
    		return back();


    	}else {
    		session()->flash('error', 'Action not accepted.');
    		return back();
    	}
    }
}
