<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Banner;
use Image;
use File;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function store(Request $request)
    {
    	$banner = new Banner;

    	$banner->title = $request->title;
        $banner->title_bd = $request->title_bd;
    	$banner->url = $request->url;
    	$banner->short_code = $request->short_code;
    	
    	if ( isset($request->image) ) {

                $image = $request->image;
                //make image name
                $img = time().'.'.$image->getClientOriginalExtension();
                //image location
                $location = public_path('images/'.$img);

                Image::make($image)->save($location);

                $banner->image = $img;

                $banner->save();
            
            
        }

        $banner->save();
    	session()->flash('success', 'Added successfully');
    	return back();

    }



    public function update(Request $request, $id)
    {

    	$banner = banner::find($id);

    	$banner->title = $request->title;
        $banner->title_bd = $request->title_bd;
    	$banner->url = $request->url;

    	if ( isset($request->image) ) {

    			if (File::exists('images/'.$banner->image)) {
    				File::delete('images/'.$banner->image);
    			}

    			$image = $request->image;
    			//make image name
    			$img = time().'.'.$image->getClientOriginalExtension();
    			//image location
    			$location = public_path('images/'.$img);

    			Image::make($image)->save($location);

    			$banner->image = $img;
    		
    		
    	}

    	$banner->save();


    	session()->flash('success', 'Updated successfully!!');
    	return back();


    	
    }


    public function delete($id)
    {

    	$banner = banner::find($id);


    	if ( isset($request->image) ) {

			if (File::exists('images/'.$banner->image)) {
				File::delete('images/'.$banner->image);
			}
    	}

    	$banner->delete();


    	session()->flash('success', 'Delete successfully!!');
    	return back();


    	
    }
}
