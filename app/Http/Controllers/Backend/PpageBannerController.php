<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Image;
use File;
use App\PpageBanner;

class PpageBannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    
    public function store(Request $request)
    {
    	$productpagebanner = new PpageBanner;

    	$productpagebanner->title = $request->title;
    	$productpagebanner->url = $request->url;

    	if ( isset($request->image) ) {

                $image = $request->image;
                //make image name
                $img = time().'.'.$image->getClientOriginalExtension();
                //image location
                $location = public_path('images/'.$img);

                Image::make($image)->save($location);

                $productpagebanner->image = $img;

                $productpagebanner->save();
            
            
        }

        $productpagebanner->save();

    	session()->flash('success', 'Added successfully');
    	return back();

    }


    public function update(Request $request, $id)
    {
    	$productpagebanner = PpageBanner::find($id);

    	$productpagebanner->title = $request->title;
    	$productpagebanner->url = $request->url;

    	if ( isset($request->image) ) {

				if (File::exists('images/'.$productpagebanner->image)) {
    				File::delete('images/'.$productpagebanner->image);
    			}

                $image = $request->image;
                //make image name
                $img = time().'.'.$image->getClientOriginalExtension();
                //image location
                $location = public_path('images/'.$img);

                Image::make($image)->save($location);

                $productpagebanner->image = $img;

                $productpagebanner->save();
            
            
        }

        $productpagebanner->save();

    	session()->flash('success', 'Updated successfully');
    	return back();

    }


    public function delete($id)
    {
    	$productpagebanner = PpageBanner::find($id);

    	if ( !is_null($productpagebanner->image) ) {
			if (File::exists('images/'.$productpagebanner->image)) {
				File::delete('images/'.$productpagebanner->image);
			}          
        }

        $productpagebanner->delete();

    	session()->flash('success', 'Delete successfully');
    	return back();
    	
    }
}
