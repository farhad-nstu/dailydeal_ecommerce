<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Slider;
use Image;
use File;

class SliderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    
    public function create()
    {
    	return view('backend.pages.slider.create');
    }
    public function store(Request $request)
    {

    	$request->validate([
    		'title' => 'required|max:150',
    		'description' => 'required',
    		'button_text' => 'required',
    		'button_link' => 'required',
    		'background_image' => 'required',
    		'slider_image' => 'required',
    		
    	]);
    	
    	$slider = new Slider;

    	$slider->title = $request->title;
        $slider->title_bd = $request->title_bd;
    	$slider->description = $request->description;
        $slider->description_bd = $request->description_bd;
    	$slider->button_text = $request->button_text;
        $slider->button_text_bd = $request->button_text_bd;
    	$slider->button_link = $request->button_link;

        if (isset($request->image_position_switch)) {
            $slider->image_reverse = 1;
        }else {
            $slider->image_reverse = 0;
        }


    	if (isset($request->title_color)) {
    		$slider->title_color = $request->title_color;
    	}
    	if (isset($request->description_color)) {
    		$slider->description_color = $request->description_color;
    	}
    	if (isset($request->button_color)) {
    		$slider->button_color = $request->button_color;
    	}

    	if ( isset($request->background_image) ) {

    			$background_image = $request->background_image;
    			//make image name
    			$img = time().'b.'.$background_image->getClientOriginalExtension();
    			//image location
    			$location = public_path('images/sliders/'.$img);

    			Image::make($background_image)->save($location);

    			$slider->background_image = $img;
    		
    		
    	}
		
		if ( isset($request->slider_image) ) {

    			$slider_image = $request->slider_image;
    			//make image name
    			$img = time().'s.'.$slider_image->getClientOriginalExtension();
    			//image location
    			$location = public_path('images/sliders/'.$img);

    			Image::make($slider_image)->save($location);

    			$slider->slider_image = $img;
    		
    		
    	}

    	$slider->save();

    	return redirect()->route('admin.slider.create');


    	
    }

    public function manage()
    {

    	$sliders = Slider::orderBy('id','desc')->get();
    	return view('backend.pages.slider.index', compact('sliders'));
    }

    public function edit($id)
    {
    	$slider = Slider::find($id);
    	return view('backend.pages.slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {

     	$request->validate([
    		'title' => 'required|max:150',
    		'description' => 'required',
    		'button_text' => 'required',
    		'button_link' => 'required',
    		
    	]);
    	
    	$slider = Slider::find($id);

    	$slider->title = $request->title;
        $slider->title_bd = $request->title_bd;
        $slider->description = $request->description;
        $slider->description_bd = $request->description_bd;
    	$slider->button_text = $request->button_text;
        $slider->button_text_bd = $request->button_text_bd;
    	$slider->button_link = $request->button_link;

        if (isset($request->image_position_switch)) {
            $slider->image_reverse = 1;
        }else {
            $slider->image_reverse = 0;
        }

    	if (isset($request->title_color)) {
    		$slider->title_color = $request->title_color;
    	}
    	if (isset($request->description_color)) {
    		$slider->description_color = $request->description_color;
    	}
    	if (isset($request->button_color)) {
    		$slider->button_color = $request->button_color;
    	}

    	if ( isset($request->background_image) ) {

    			if (File::exists('images/sliders/'.$slider->background_image)) {
    				File::delete('images/sliders/'.$slider->background_image);
    			}

    			$background_image = $request->background_image;
    			//make image name
    			$img = time().'b.'.$background_image->getClientOriginalExtension();
    			//image location
    			$location = public_path('images/sliders/'.$img);

    			Image::make($background_image)->save($location);

    			$slider->background_image = $img;
    		
    		
    	}
		
		if ( isset($request->slider_image) ) {

				if (File::exists('images/sliders/'.$slider->slider_image)) {
	    			File::delete('images/sliders/'.$slider->slider_image);
	    		}

    			$slider_image = $request->slider_image;
    			//make image name
    			$img = time().'s.'.$slider_image->getClientOriginalExtension();
    			//image location
    			$location = public_path('images/sliders/'.$img);

    			Image::make($slider_image)->save($location);

    			$slider->slider_image = $img;
    		
    		
    	}

    	$slider->save();

    	session()->flash('success', 'Slider updated successfully!!');
    	return redirect()->route('admin.sliders');


    	
    }
    public function delete($id)
    {
    	$slider = Slider::find($id);

    	if (File::exists('images/sliders/'.$slider->slider_image)) {
			File::delete('images/sliders/'.$slider->slider_image);
		}
		if (File::exists('images/sliders/'.$slider->background_image)) {
			File::delete('images/sliders/'.$slider->background_image);
		}

    	if (!is_null($slider)) {
    		$slider->delete();
    	}

    	session()->flash('success', 'Slider has been deleted successfully!!');
    	return back();
    }


    public function duplicate($id)
    {
        $slider = Slider::find($id);
        $new_slider = $slider->replicate();
        $new_slider->save();
        return back();
    }

    //slider image delete

    public function sliderImageDelete($id)
    {
        $slider = Slider::find($id);
        if (File::exists('images/sliders/'.$slider->slider_image)) {
            File::delete('images/sliders/'.$slider->slider_image);
        }

        $slider->slider_image = Null;
        $slider->save();
        session()->flash('success','Image removed successfully');
        return back();
    }


    public function sliderBackgroundImageDelete($id)
    {
        $slider = Slider::find($id);
        if (File::exists('images/sliders/'.$slider->background_image)) {
            File::delete('images/sliders/'.$slider->background_image);
        }

        $slider->background_image = Null;
        $slider->save();
        session()->flash('success','Image removed successfully');
        return back();
    }
}
