<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Slider;
use App\Category;
use App\Offer;
use App\Page;

class PagesController extends Controller
{

    //home page
    public function index() {
    	$sliders = Slider::orderBy('id', 'desc')->get();
    	$products = Product::orderBy('id', 'desc')->get();
    	$feature_products = Product::where('featured',1)->orderBy('id','desc')->paginate(40);
    	return view('frontend.pages.index', compact('sliders','products','feature_products'));
    }

    //show pages

    public function show($slug)
    {
        $page = Page::where('slug',$slug)->first();


        if (!is_null($page)) {
            return view('frontend.pages.single', compact('page'));
        }
        else {
            session()->flash('errors', 'Sorry there is no page for this url');
            return redirect()->route('index');
        }
    }

    //search page
    public function search(Request $request) {
    	$search = $request->search;

    	if ($request->categories === Null) {
    		$products = Product::orWhere('title','like','%'.$search.'%')
	    	->orWhere('description', 'like','%'.$search.'%')
	    	->orderBy('id', 'desc')->paginate(40);
    	}
    	else {
    		$products = Product::orWhere('category_id',$request->categories)->orWhere('title','like','%'.$search.'%')
	    	->orWhere('description', 'like','%'.$search.'%')
	    	->orderBy('id', 'desc')->paginate(40);
    	}
    	


    	return view('frontend.pages.product.search', compact('products','search'));
    }

    public function ajaxsearch(Request $request) {
    	$search = $request->search;

    	if ($request->categories === Null) {
    		$products = Product::orWhere('title','like','%'.$search.'%')
	    	->orWhere('description', 'like','%'.$search.'%')
	    	->orderBy('id', 'desc')->get();
    	}
    	else {
    		$products = Product::orWhere('category_id',$request->categories)->orWhere('title','like','%'.$search.'%')
	    	->orWhere('description', 'like','%'.$search.'%')
	    	->orderBy('id', 'desc')->get();
    	}
    	
        $product_container = '';
        foreach ($products as $product) {
            $product_link = route('product.show', $product->slug);

            $i = 1;
            if(!is_null($product->images)):
                foreach($product->images as $image):
                    if($i>0):
                        $image_link = asset('images/'.$image->image);
                    endif;

                    $i--;
                endforeach;
            else:
                $image_link =asset('images/no-img.jpg');
            endif;

            $attributes = $product->attribute_options;
            $options = '';

            if (!is_null($attributes)):
            $unserialize_attributes = unserialize($attributes);
            $all_keys = array_keys($unserialize_attributes);
            foreach($all_keys as $key):

            foreach($unserialize_attributes[$key] as $value):
                        $value_as_array = explode(',', $value);
                        //print_r($value_as_array);
                    foreach($value_as_array as $option):
                        $options .= "<option>$option</option>";
                    endforeach;
            endforeach;
            endforeach;
            endif;

            $product_container .= "
 
                            <li class='col-6 col-md-3 col-wd-2gdot4'>
                                <div class='col-12' id='single_product_id'>
                                    <input type='hidden' class='product_id' value='$product->id' >
                                        <div class='product-item__outer h-100'>
                                            <div class='product-item__inner bg-white px-wd-4 p-2 p-md-3'>
                                                <div class='product-item__body pb-xl-2'>
                                                    <h5 class='mb-1 product-item__title'><a href='$product_link' class='text-blue font-weight-bold'>
                                                        
                                                            $product->title;
                                                        
                                                    
                                                    </a></h5>
                                                    <div class='mb-2'>
                                                        <a href='$product_link' class='d-block text-center'>
                                                            

                                                            
                                                                    <img src='$image_link' class='img-fluid' style='width: 172px; height:172px'>
                                                                
                                                            
                                                        </a>
                                                    </div>
                                                    <div class='flex-center-between mb-1'>
                                                        <div class='prodcut-price col-12'>
                                                            <div class='text-gray-100' style='text-align: center;'>

                                                                
                                                                <select class='col-12 js-select selectpicker dropdown-select ml-3'
                                                                data-style='btn-sm bg-white font-weight-normal py-2 border'>
                                                                $options


                                                                </select>
                                                            </div>
                                                            
                                                        </div>
                                                        


                                                        
                                                        
                                                    </div>

                                                    <div class='flex-center-between mb-1 quantity-container'>
                                                        <div class='border rounded-pill py-2 px-3 border-color-1'>
                                                            <div class='js-quantity row align-items-center'>
                                                                <div class='col'>
                                                                    <input class='js-result form-control h-auto border-0 rounded p-0 shadow-none' type='text' value='1'>
                                                                </div>
                                                                <div class='col-auto pr-1'>
                                                                    <a class='js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0' href='javascript:;'>
                                                                        <small class='fas fa-minus btn-icon__inner'></small>
                                                                    </a>
                                                                    <a class='js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0' href='javascript:;'>
                                                                        <small class='fas fa-plus btn-icon__inner'></small>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Quantity -->
                                                    </div>

                                                    <div class='flex-center-between mb-1 quantity-container'>
                                                        <div class=''>
                                                            <a href='#' class='btn btn-primary-dark transition-3d-hover add_to_cart_button'><i class='ec ec-add-to-cart mr-2 font-size-20'></i> Add to Cart</a>
                                                        </div>
                                                    </div>

                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                            </li>
                            

            
            ";
        }
    	return $product_container;
    }

    //Show product categories

    public function categorySingle($slug)
    {
        $category = Category::where('slug',$slug)->first();
        
        $products = Product::orderBy('id','desc')->where('category_id',$category->id)->paginate(40);
        if (count($products) > 0) {
            //return view('frontend.pages.product.categorysingle', compact('category','products'));
            
            return view('frontend.pages.product.categorysingle', compact('category','products'));
        }
        else {
            // if there is no product in this category
            return view('frontend.pages.product.noproduct');
        }


    }

    public function brandSingle($id)
    {
        
        $products = Product::orderBy('id','desc')->where('brand_id',$id)->paginate(40);
        if (count($products) > 0) {
            
            return view('frontend.pages.product.index', compact('products'));
        }
        else {
            // if there is no product in this category
            return view('frontend.pages.product.noproduct');
        }


    }

    public function offer($slug)
    {
        $offer = Offer::where('slug',$slug)->first();
        $product_ids = $offer->product_id;

        $product_ids_array = explode(',', $product_ids);

        foreach ($product_ids_array as $product_id) {
            $products[] = Product::orderBy('id','desc')->where('id',$product_id)->first();
        }


        return view('frontend.pages.product.offer', compact('offer','products'));
        
    }
    
}
