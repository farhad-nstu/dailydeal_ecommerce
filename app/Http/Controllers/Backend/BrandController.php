<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Brand;
use Image;
use File;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    
    public function create()
    {
    	return view('backend.pages.brand.create');
    }
    public function store(Request $request)
    {

    	$request->validate([
    		'name' => 'required|max:150',
    		
    	]);
    	
    	$brand = new Brand;

    	$brand->name = $request->name;
        $brand->name_bd = $request->name_bd;

    	$brand->description = $request->description;
  

    	if ( isset($request->image) ) {

    			$image = $request->image;
    			//make image name
    			$img = time().'.'.$image->getClientOriginalExtension();
    			//image location
    			$location = public_path('images/brands/'.$img);

    			Image::make($image)->save($location);

    			$brand->image = $img;
    		
    		
    	}

    	$brand->save();


    	session()->flash('success', 'Brand has been added successfully!!');
    	return redirect()->route('admin.brand.create');


    	
    }

    public function manage()
    {

    	$brands = Brand::orderBy('name','asc')->get();
    	return view('backend.pages.brand.index', compact('brands'));
    }

    public function edit($id)
    {
    	$brand = Brand::find($id);
    	return view('backend.pages.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {

    	$request->validate([
    		'name' => 'required|max:150',
    		
    	]);
    	
    	$brand = Brand::find($id);

    	$brand->name = $request->name;
        $brand->name_bd = $request->name_bd;
    	$brand->description = $request->description;

    	if ( isset($request->image) ) {

    			if (File::exists('images/brands/'.$brand->image)) {
    				File::delete('images/brands/'.$brand->image);
    			}

    			$image = $request->image;
    			//make image name
    			$img = time().'.'.$image->getClientOriginalExtension();
    			//image location
    			$location = public_path('images/brands/'.$img);

    			Image::make($image)->save($location);

    			$brand->image = $img;
    		
    		
    	}

    	$brand->save();
    	session()->flash('success', 'Brand updated successfully!!');
    	return redirect()->route('admin.brands');


    	
    }
    public function delete($id)
    {
    	$brand = Brand::find($id);

    	if (File::exists('images/brands/'.$brand->image)) {
			File::delete('images/brands/'.$brand->image);
		}

    	if (!is_null($brand)) {
    		$brand->delete();
    	}

    	session()->flash('success', 'Category has been deleted successfully!!');
    	return back();
    }
}
