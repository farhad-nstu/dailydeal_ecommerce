<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Category;
use Image;
use File;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function create()
    {
    	$main_categories = Category::orderBy('name','asc')->where('parent_id', Null)->get();
        $sub_categories = Category::orderBy('name','asc')->whereNotNull('parent_id')->get();

    	return view('backend.pages.category.create', compact('main_categories','sub_categories'));
    }
    public function store(Request $request)
    {

    	$request->validate([
    		'name' => 'required|max:150',
    		
    	]);
    	
    	$category = new Category;

    	$category->name = $request->name;
        $category->name_bd = $request->name_bd;

    	if (isset($request->description)) {
    		$category->description = $request->description;
    	}
    	if (isset($request->parentcategory)) {
    		$category->parent_id = $request->parentcategory;
    	}
        $new_slug= Str::slug($request->name,'-');

        $checkifsameslughas = Category::orWhere('slug','like','%'.$new_slug.'%')->get();
        if (count($checkifsameslughas) > 0) {
            $slug_last_value = count($checkifsameslughas)+1;
            $final_slug = $new_slug."-".$slug_last_value;
            $category->slug = $final_slug;
        }
        else {
            $category->slug = $new_slug;
        }

        if ( isset($request->image) ) {

                $image = $request->image;
                //make image name
                $img = time().'.'.$image->getClientOriginalExtension();
                //image location
                $location = public_path('images/categories/'.$img);

                Image::make($image)->save($location);

                $category->image = $img;

                $category->save();
            
            
        }

        if ( isset($request->thumbnail) ) {

                $thumbnail = $request->thumbnail;
                //make thumbnail name
                $img = time().'t.'.$thumbnail->getClientOriginalExtension();
                //image location
                $location = public_path('images/categories/'.$img);

                Image::make($thumbnail)->save($location);

                $category->thumbnail = $img;

                $category->save();
            
            
        }

        
    	$category->save();

    	
        session()->flash('success', 'Category added successfully.');
    	return back();


    	
    }

    public function manage()
    {

    	$categories = Category::orderBy('name','asc')->get();
    	return view('backend.pages.category.index', compact('categories'));
    }

    public function edit($id)
    {
        $main_categories = Category::orderBy('name','asc')->where('parent_id', Null)->get();
        $sub_categories = Category::orderBy('name','asc')->whereNotNull('parent_id')->get();

    	$category = Category::find($id);
    	return view('backend.pages.category.edit', compact('category','main_categories','sub_categories'));
    }

    public function update(Request $request, $id)
    {

    	$request->validate([
    		'name' => 'required|max:150',
    		
    	]);
    	
    	$category = Category::find($id);

    	$category->name = $request->name;
        $category->name_bd = $request->name_bd;

    	if (isset($request->description)) {
    		$category->description = $request->description;
    	}
    	if (isset($request->parentcategory)) {
    		$category->parent_id = $request->parentcategory;
    	}

    	$category->save();

    	if ( isset($request->image) ) {

    			if (File::exists('images/categories/'.$category->image)) {
    				File::delete('images/categories/'.$category->image);
    			}

    			$image = $request->image;
    			//make image name
    			$img = time().'.'.$image->getClientOriginalExtension();
    			//image location
    			$location = public_path('images/categories/'.$img);

    			Image::make($image)->save($location);

    			$category->image = $img;

    			$category->save();
    		
    		
    	}

        if ( isset($request->thumbnail) ) {

                if (File::exists('images/categories/'.$category->thumbnail)) {
                    File::delete('images/categories/'.$category->thumbnail);
                }

                $thumbnail = $request->thumbnail;
                //make thumbnail name
                $img = time().'t.'.$thumbnail->getClientOriginalExtension();
                //image location
                $location = public_path('images/categories/'.$img);

                Image::make($thumbnail)->save($location);

                $category->thumbnail = $img;

                $category->save();
            
            
        }


    	session()->flash('success', 'Category updated successfully!!');
    	return back();


    	
    }

    //image delete

    public function categoryImageDelete($id)
    {
        $category = Category::find($id);
        if (File::exists('images/categories/'.$category->image)) {
            File::delete('images/categories/'.$category->image);
        }

        $category->image = Null;
        $category->save();
        session()->flash('success','Image removed successfully');
        return back();
    }


    //image delete

    public function categoryThumbnailDelete($id)
    {
        $category = Category::find($id);
        if (File::exists('images/categories/'.$category->thumbnail)) {
            File::delete('images/categories/'.$category->thumbnail);
        }

        $category->thumbnail = Null;
        $category->save();
        session()->flash('success','Image removed successfully');
        return back();
    }


    public function delete($id)
    {
    	$category = Category::find($id);
    	$all_sub_category = Category::where('parent_id', $id)->get();

    	//Delete all subcategory under this category
    	
    	foreach ($all_sub_category as $sub_category) {
			   if (File::exists('images/categories/'.$sub_category->image)) {
					File::delete('images/categories/'.$sub_category->image);
				}
    		$sub_category->delete();
    	}

    	if (File::exists('images/categories/'.$category->image)) {
			File::delete('images/categories/'.$category->image);
		}

    	if (!is_null($category)) {
    		$category->delete();
    	}

    	session()->flash('success', 'Category has been deleted successfully!!');
    	return back();
    }

}
