<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Testimonial;
use Image;
use File;


class TestimonialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    
    public function store(Request $request)
    {
    	$testimonial = new Testimonial;

    	$testimonial->name = $request->name;
        $testimonial->name_bd = $request->name_bd;
    	$testimonial->comment = $request->comment;
        $testimonial->comment_bd = $request->comment_bd;
    	
    	if ( isset($request->image) ) {

                $image = $request->image;
                //make image name
                $img = time().'.'.$image->getClientOriginalExtension();
                //image location
                $location = public_path('images/'.$img);

                Image::make($image)->save($location);

                $testimonial->image = $img;

                $testimonial->save();
            
            
        }

        $testimonial->save();
    	session()->flash('success', 'Added successfully');
    	return back();

    }



    public function update(Request $request, $id)
    {

    	$testimonial = Testimonial::find($id);

    	$testimonial->name = $request->name;
        $testimonial->name_bd = $request->name_bd;
        $testimonial->comment = $request->comment;
        $testimonial->comment_bd = $request->comment_bd;

    	if ( isset($request->image) ) {

    			if (File::exists('images/'.$testimonial->image)) {
    				File::delete('images/'.$testimonial->image);
    			}

    			$image = $request->image;
    			//make image name
    			$img = time().'.'.$image->getClientOriginalExtension();
    			//image location
    			$location = public_path('images/'.$img);

    			Image::make($image)->save($location);

    			$testimonial->image = $img;
    		
    		
    	}

    	$testimonial->save();


    	session()->flash('success', 'Updated successfully!!');
    	return back();


    	
    }


    public function delete($id)
    {

    	$testimonial = Testimonial::find($id);


    	if ( isset($request->image) ) {

			if (File::exists('images/'.$testimonial->image)) {
				File::delete('images/'.$testimonial->image);
			}
    	}

    	$testimonial->delete();


    	session()->flash('success', 'Delete successfully!!');
    	return back();


    	
    }
}
