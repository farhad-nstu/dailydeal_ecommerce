<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Product;
use App\ProductImage;
use Image;

use App\AttributeSet;
use App\Attribute;
use App\Category;
use App\Brand;
use App\Offer;
use File;
use Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:vendor');
    }

    public function create()
    {
    	return view('backend.vendor.product.create');
    }

    public function store(Request $request)
    {

    	$request->validate([
    		'title' => 'required|max:150',
    		'description' => 'required',
    		'price' => 'required',
    		'quantity' => 'required',
    		
    	]);
    	
    	$product = new Product;

    	$product->title = $request->title;
        $product->title_bd = $request->title_bd;
    	$product->description = $request->description;
        $product->description_bd = $request->description_bd;
        $product->specifications = $request->specifications;
        $product->specifications_bd = $request->specifications_bd;
    	$product->price = $request->price;
        $product->offer_price = $request->offer_price;
    	$product->quantity = $request->quantity;
    	//$product->slug = Str::slug($request->title,'-');

        $new_slug= Str::slug($request->title,'-');

        $checkifsameslughas = Product::orWhere('slug','like','%'.$new_slug.'%')->get();
        if (count($checkifsameslughas) > 0) {
            $slug_last_value = count($checkifsameslughas)+1;
            $final_slug = $new_slug."-".$slug_last_value;
            $product->slug = $final_slug;
        }
        else {
            $product->slug = $new_slug;
        }

        $product->sku = $request->sku;
    	$product->category_id = $request->category;
    	$product->brand_id = $request->brand;
    	$product->vendor_id = Auth::user()->id;

        if (strlen($request->attribute_option[0]) > 0 && strlen($request->attribute_name[0])) {
            $total_attribute = count($request->attribute_name);
        
            for ($i=0; $i < $total_attribute ; $i++) { 

                $attributes[$request->attribute_name[$i]][] = $request->attribute_option[$i];
            }

            $product->attribute_options = serialize($attributes);
            
        }else {
            $product->attribute_options = Null;
        }
       
        

    	$product->save();

    	if ( isset($request->product_image) && count($request->product_image) > 0) {
    		$i = 1;
    		foreach ($request->product_image as $image) {
    			//make image name
    			$img = time().$i.'.'.$image->getClientOriginalExtension();
    			//image location
    			$location = public_path('images/'.$img);

    			Image::make($image)->save($location);

    			$product_image = new ProductImage;

    			$product_image->image = $img;
    			$product_image->product_id = $product->id;

    			$product_image->save();
    			$i++;
    		}
    	}

        session()->flash('success', 'Product has been added successfully!!');

    	return redirect()->route('vendor.product.create');


    	
    }

    public function manage()
    {
        $products = Product::orderBy('id','desc')->where('vendor_id', Auth::user()->id)->get();
        return view('backend.vendor.product.index')->with('products',$products);
    }

    public function edit($id)
    {
        $product = Product::where('id',$id)->where('vendor_id', Auth::user()->id)->first();
        
        if (!is_null($product)) {
            $categories = Category::orderBy('name', 'asc')->get();
            $main_categories = Category::orderBy('name','asc')->where('parent_id', Null)->get();
            $sub_categories = Category::orderBy('name','asc')->whereNotNull('parent_id')->get();
            $brands = Brand::orderBy('name', 'asc')->get();
            return view('backend.vendor.product.editupdate',compact('product','categories','main_categories','sub_categories','brands'));
        }else {
            session()->flash('danger',"We coudln't find this product.");
            return back();
        }
        
        //return view('backend.pages.product.edit')->with('product',$product);
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required|max:150',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            
        ]);
        
        $product = Product::where('id',$id)->where('vendor_id', Auth::user()->id)->first();

        if (!is_null($product)) {
            $product->title = $request->title;
        $product->title_bd = $request->title_bd;
        $product->description = $request->description;
        $product->description_bd = $request->description_bd;
        $product->specifications = $request->specifications;
        $product->specifications_bd = $request->specifications_bd;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->quantity = $request->quantity;
        //$product->slug = Str::slug($request->title,'-');
        $product->sku = $request->sku;
        $product->category_id = $request->category;
        $product->brand_id = $request->brand;
        $product->admin_id = 1;
        if (strlen($request->attribute_option[0]) > 0 && strlen($request->attribute_name[0])) {
            $total_attribute = count($request->attribute_name);
        
            for ($i=0; $i < $total_attribute ; $i++) { 

                $attributes[$request->attribute_name[$i]][] = $request->attribute_option[$i];
            }

            $product->attribute_options = serialize($attributes);
            
        }else {
            $product->attribute_options = Null;
        }
        

        
        

        $product->save();

        if ( isset($request->product_image) && count($request->product_image) > 0) {
            $i = 1;
            foreach ($request->product_image as $image) {
                //make image name
                $img = time().$i.'.'.$image->getClientOriginalExtension();
                //image location
                $location = public_path('images/'.$img);

                Image::make($image)->save($location);

                $product_image = new ProductImage;

                $product_image->image = $img;
                $product_image->product_id = $product->id;

                $product_image->save();
                $i++;
            }
            
        }
        

        session()->flash('success', 'Product has been updated successfully!!');
        return back();
        }else {
            session()->flash('danger',"We coudln't find this product.");
            return back();
        }
        


        
    }


    public function delete($id)
    {
        $product = Product::where('id',$id)->where('vendor_id', Auth::user()->id)->first();

        if (!is_null($product)) {
            //Delete Product Image
            $product_images = ProductImage::where('product_id', $product->id)->get();

            foreach ($product_images as $product_image) {
                if (File::exists('images/'.$product_image->image)) {
                File::delete('images/'.$product_image->image);
                $product_image->delete();
                }
            }

            //Remove from offers

            $offers = Offer::orWhere('product_id','like','%'.$product->id.'%')->get();

            if (!is_null($offers)) {
                foreach ($offers as $offer) {
                $replaced_product_id = str_replace(",$product->id","","$offer->product_id");
                $new_offer = Offer::find($offer->id);
                $new_offer->product_id = $replaced_product_id;
                $new_offer->save();

                }
            }
            
            

            if (!is_null($product)) {
                $product->delete();
            }

            session()->flash('success', 'Product has been deleted successfully!!');
            return back();
            }else {
            session()->flash('danger',"We coudln't find this product.");
            return back();
            }
        
    }


    public function imageDelete($image_id,$product_id)
    {
        $product = Product::where('id',$product_id)->where('vendor_id', Auth::user()->id)->first();
        if (!is_null($product)) {
            $product_image = ProductImage::find($image_id);
            if ($product_image->product_id === $product->id) {
                $product_image->delete();
            }
            session()->flash('success',"Image deleted.");
            return back();
        }else {
            session()->flash('danger',"This image don't exists");
            return back();
        }
       
    
    }


}
