<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\General;
use Image;
use File;

class GeneralController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    
    public function edit($id)
    {
    	$general = General::find($id);

    	return view('backend.pages.general.create', compact('general'));
    }
    public function update(Request $request, $id)
    {
    	$request->validate([
    		'about' => 'required',
    		'copyright' => 'required',
    		'address' => 'required',
    		'email' => 'required',
    		'phone_number' => 'required',

    		
    	]);
    	
    	$general = General::find($id);

    	if ( isset($request->logo) ) {

    			if (File::exists('images/'.$general->image)) {
    				File::delete('images/'.$general->image);
    			}

    			$logo = $request->logo;
    			//make image name
    			$img = time().'l.'.$logo->getClientOriginalExtension();
    			//image location
    			$location = public_path('images/'.$img);

    			Image::make($logo)->save($location);

    			$general->logo = $img;
    		
    		
    	}

    	$general->about = $request->about;
        $general->about_bd = $request->about_bd;
    	$general->copyright = $request->copyright;
        $general->copyright_bd = $request->copyright_bd;
    	$general->address = $request->address;
        $general->address_bd = $request->address_bd;
    	$general->email = $request->email;
    	$general->phone_number = $request->phone_number;
        $general->phone_number_bd = $request->phone_number_bd;
    	$general->website = $request->website;
        $general->meta_name = $request->meta_name;
        $general->meta_description = $request->meta_description;
    	$general->facebook = $request->facebook;
    	$general->twitter = $request->twitter;
    	$general->linkedin = $request->linkedin;
    	$general->google = $request->google;

    	

    	$general->save();
        session()->flash('success','Updated');
    	return back();
    }
    
}
