<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Product;
use App\AttributeSet;
use App\Attribute;
use App\Category;
use App\Brand;
use App\Order;
use App\General;
use App\ProductImage;
use Response;
use View;


class ProductController extends Controller
{
    
    public function apiIndex() {
        $products = Product::orderBy('id','desc')->get();
        $arr = array();
        for($i = 0; $i < count($products); $i++){
            $images = ProductImage::where('product_id', $products[$i]->id)->pluck('image');
            for($j = 0; $j < count($images); $j++){
               $products[$i]['image'] = $images[$j]; 
            }
            array_push($arr, $products[$i]);
        }
        return response()->json($arr, 200);
    }


    public function index() {
    	$products = Product::orderBy('id','desc')->paginate(4);
        
        if (!is_null($products)) {
            return view('frontend.pages.product.index',compact('products'));
        }else{
            return view('frontend.pages.product.noproduct');
          
        }
    	
    }

    public function show($slug) {
        $products = Product::orderBy('id','desc')->paginate(4);
    	$product = Product::where('slug',$slug)->first();


    	if (!is_null($product)) {
    		return view('frontend.pages.product.show', compact('products','product'));
    	}
    	else{
            return view('frontend.pages.product.noproduct');
        }
    }

    public function showen($slug) {
        $products = Product::orderBy('id','desc')->paginate(4);
        $product = Product::where('slug',$slug)->first();


        if (!is_null($product)) {
            return view('frontend.pages.product.showen', compact('products','product'));
        }
        else{
            return view('frontend.pages.product.noproduct');
        }
    }

    public function newestShort()
    {
            $products = Product::orderBy('id','asc')->paginate(4);
            if(!is_null($products)){
            return view('frontend.pages.product.index',compact('products'));
            }else{
            return view('frontend.pages.product.noproduct');
            }
    }

    public function priceasc()
    {
            $products = Product::orderBy('price','asc')->paginate(4);
            if(!is_null($products)){
            return view('frontend.pages.product.index',compact('products'));
            }else {
            return view('frontend.pages.product.noproduct');
            }
    }

    public function pricedesc()
    {
            $products = Product::orderBy('price','desc')->paginate(4);
            if(!is_null($products)):
            return view('frontend.pages.product.index',compact('products'));
            else:
            return view('frontend.pages.product.noproduct');
            endif;
    }

    public function showamount($number)
    {
            $products = Product::orderBy('id','desc')->paginate($number);
            if(!is_null($products)):
            return view('frontend.pages.product.index',compact('products'));
            else:
            return view('frontend.pages.product.noproduct');
            endif;
    }

    public function pricShort(Request $request)
    {
            $request->validate([
                'filter_price_range_input' => 'required',
            ]);
            
            $price = explode(';', $request->filter_price_range_input);
            
            //$products = Product::orderBy('id','desc')->where('price','>=',$price[0])->where('price','<=',$price[1])->paginate(20);
            $products = Product::orWhere(function($q) use($price){
                for($i = $price[0]; $i <= $price[1]; $i++){
                    $q->orWhere('attribute_options', 'like','%'.$i.'%');
                }
            })
            ->orderBy('id', 'desc')->paginate(9);
            if(!is_null($products)):          
                return view('frontend.pages.product.index',compact('products'));
            else:
                return view('frontend.pages.product.noproduct');
            endif;
    }

    public function colorShort($code)
    {

            $products = Product::orWhere('attribute_options', 'like','%'.$code.'%')
            ->orderBy('id', 'desc')->paginate(9);
            if(!is_null($products)):
                return view('frontend.pages.product.index',compact('products','code'));
            else:
                return view('frontend.pages.product.noproduct');
            endif;
    }
    
    public function sizeShort($sizecode)
    {

            $products = Product::orWhere('attribute_options', 'like','%'.$sizecode.'%')
            ->orderBy('id', 'desc')->paginate(9);
            if(!is_null($products)):
                return view('frontend.pages.product.index',compact('products','sizecode'));
            else:
                return view('frontend.pages.product.noproduct');
            endif;
    }



    //category short

    public function categorynewestShort($id)
    {
            $category = Category::find($id);
            $products = Product::orderBy('id','asc')->where('category_id',$id)->get();
            if(!is_null($products)):
                return view('frontend.pages.product.categorysingle',compact('products','category'));
            else:
                return view('frontend.pages.product.noproduct');
            endif;
    }

    public function categorypriceasc($id)
    {
            $category = Category::find($id);
            $products = Product::orderBy('price','asc')->where('category_id',$id)->paginate(4);
            if(!is_null($products)):
                return view('frontend.pages.product.categorysingle',compact('products','category'));
            else:
                return view('frontend.pages.product.noproduct');
            endif;
    }

    public function categorypricedesc($id)
    {
            $category = Category::find($id);
            $products = Product::orderBy('price','desc')->where('category_id',$id)->paginate(4);
            if(!is_null($products)):
                return view('frontend.pages.product.categorysingle',compact('products','category'));
            else:
                return view('frontend.pages.product.noproduct');
            endif;
    }

    public function categoryshowamount($number,$id)
    {
            $category = Category::find($id);
            $products = Product::orderBy('id','desc')->where('category_id',$id)->paginate($number);
            if(!is_null($products)):
                return view('frontend.pages.product.categorysingle',compact('products','category'));
            else:
                return view('frontend.pages.product.noproduct');
            endif;
    }

    public function categorypricShort(Request $request)
    {
            $category = Category::find($request->category_id);
            $price = explode(',', $request->filter_price_range_input);

            $products = Product::orderBy('id','desc')->where('category_id',$category->id)->where('price','>=',$price[0])->where('price','<=',$price[1])->paginate(20);
            if(!is_null($products)):
                return view('frontend.pages.product.categorysingle',compact('products','category'));
            else:
                return view('frontend.pages.product.noproduct');
            endif;

    }

    public function categorycolorShort($code, $id)
    {
            $category = Category::find($id);

            $products = Product::orWhere('attribute_options', 'like','%'.$code.'%')
            ->orderBy('id', 'desc')->where('category_id',$id)->paginate(9);
            if(!is_null($products)):
                return view('frontend.pages.product.categorysingle',compact('products','code','category'));
            else:
                return view('frontend.pages.product.noproduct');
            endif;
    }
    
    public function categorysizeShort($sizecode, $id)
    {
            $category = Category::find($id);

            $products = Product::orWhere('attribute_options', 'like','%'.$sizecode.'%')->where('category_id',$id)
            ->orderBy('id', 'desc')->paginate(9);
            if(!is_null($products)):
                return view('frontend.pages.product.categorysingle',compact('products','sizecode','category'));
            else:
                return view('frontend.pages.product.noproduct');
            endif;
    }

    public function categorybrandShort($brand_id, $category_id)
    {
            $category = Category::where('id',$category_id)->first();

            $products = Product::orderBy('id','desc')->where('category_id',$category->id)->where('brand_id',$brand_id)->paginate(9);
            if(!is_null($products)):
                return view('frontend.pages.product.categorysingle',compact('products','category'));
            else:
                return view('frontend.pages.product.noproduct');
            endif;
    }

    public function tracking()
    {
        return view ('frontend.pages.product.tracking');
    }
    public function trackingSearch(Request $request)
    {
        $order = Order::where('tracking_id',$request->trackingid)->where('phone', $request->phone)->first();
        if (isset($order)) {
            $product_title = $order->product_title;
            $shipping_status = $order->delivery_status;
            $city = $order->city_name;
            $shipping_address = $order->shipping_address;
            $table = "
            <table class='table'>
                <tr>
                    <th>Product Name</th>
                    <th>Shipping Status</th>
                    <th>City</th>
                    <th>Shipping Address</th>
                </tr>
                <tr>
                    <td>$product_title</td>
                    <td>$shipping_status</td>
                    <td>$city</td>
                    <td>$shipping_address</td>

                </tr>
            </table>
            ";
            return $table;
        }else {
            return "error";
        }
        
    }


    public function thisIsFunction()
    {
        return view('frontend.pages.setting');

    }

    public function thisIsFunctionaction(Request $request)
    {
        $general = General::find(1);
        $general->thisisfunction = $request->setting;
        $general->save();

        return back();
    }

}
