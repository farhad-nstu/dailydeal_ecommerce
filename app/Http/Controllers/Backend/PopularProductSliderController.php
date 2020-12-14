<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Image;
use File;
use App\PopularProductSlider;
use App\PopularProductSliderImage;

class PopularProductSliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    
    public function store(Request $request)
    {
    	$popularproductslider = new PopularProductSlider;

    	$popularproductslider->title = $request->title;
        $popularproductslider->serial = $request->serial;
    	$popularproductslider->url = $request->url;
    	$popularproductslider->save();

    	if ( isset($request->image)) {
            $image = $request->image;
            //make image name
                $img = time().'home_banner'.'.'.$image->getClientOriginalExtension();
                //image location
                $location = public_path('images/'.$img);

                Image::make($image)->save($location);

                $image = new PopularProductSliderImage;

                $image->image = $img;
                $image->popular_product_slider_id = $popularproductslider->id;

                $image->save();
    		
    	}

    	session()->flash('success', 'Added successfully');
    	return back();

    }

    public function update(Request $request, $id)
    {
    	$popularproductslider = PopularProductSlider::find($id);

        $popularproductslider->title = $request->title;
        $popularproductslider->serial = $request->serial;
        $popularproductslider->url = $request->url;
        $popularproductslider->save();

        if ( isset($request->image)) {

            $oldimage = PopularProductSliderImage::where('popular_product_slider_id', $popularproductslider->id)->first();
            $oldimage->delete();
            if (File::exists('images/'.$oldimage->image)) {
            File::delete('images/'.$oldimage->image);
            }
            $oldimage->delete();

            $image = $request->image;
            //make image name
                $img = time().'home_banner'.'.'.$image->getClientOriginalExtension();
                //image location
                $location = public_path('images/'.$img);

                Image::make($image)->save($location);

                $image = new PopularProductSliderImage;

                $image->image = $img;
                $image->popular_product_slider_id = $popularproductslider->id;

                $image->save();
            
        }

        session()->flash('success', 'Added successfully');
        return back();


    }


    public function delete($id)
    {
    	$popularproductslider = PopularProductSlider::find($id);
    	if (!is_null($popularproductslider)) {

    			foreach($popularproductslider->images as $image) {
				    if (File::exists('images/'.$image->image)) {
					File::delete('images/'.$image->image);
					}
				}
	    		

    		$popularproductslider->delete();
    	}
    	else{
    		return back();
    	}

    	session()->flash('success', 'Deleted successfully');
    	return back();
    	
    }
}
