<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Product;
use App\Offer;

class OfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    
    public function create()
    {
    	//$products = Product::orderBy('id', 'desc')->paginate(20);
    	return view('backend.pages.offer.create');
    }


    public function createnext()
    {
        $products = Product::orderBy('id', 'desc')->paginate(20);
        //get last order
        $offer = Offer::orderBy('id', 'desc')->first();
        return view('backend.pages.offer.addproducts', compact('products', 'offer') );


    }



    public function store(Request $request)
    {
    	$offer = new Offer;
    	$offer->name = $request->name;
    	$offer->start = $request->start;
    	$offer->end = $request->end;
    	$offer->continue = $request->continue;

        $new_slug= Str::slug($request->name,'-');

        $checkifsameslughas = Offer::orWhere('slug','like','%'.$new_slug.'%')->get();
        if (count($checkifsameslughas) > 0) {
            $slug_last_value = count($checkifsameslughas)+1;
            $final_slug = $new_slug."-".$slug_last_value;
            $offer->slug = $final_slug;
        }
        else {
            $offer->slug = $new_slug;
        }

    	$offer->save();
        return redirect()->route('admin.offer.createnext');

    }

    public function addproducts($product_id, $offer_id)
    {
        $offer = Offer::find($offer_id);

        if (is_null($offer->product_id)) {
            $offer->product_id = $product_id;
        }
        else {
            $array = explode(',',$offer->product_id);

            if (in_array($product_id,$array)) {

                unset($array[array_search($product_id,$array)]);

                $new_product_ids = implode(',', $array);

                $offer->product_id = $new_product_ids;

                echo $new_product_ids;
                $offer->save();
                return back();

            }
            else {
                $products_all = $offer->product_id.','.$product_id;
                $offer->product_id = $products_all;
                echo $products_all;
            }
            
        }



        $offer->save();
        
        return back();
    }


    public function manage()
    {
        $offers = Offer::orderBy('id', 'desc')->get();

        return view('backend.pages.offer.index', compact('offers') ); 
    }

    //Add products from index page
    public function addmoreproducts($id)
    {
        $products = Product::orderBy('id', 'desc')->paginate(20);
        //get last order
        $offer = Offer::find($id);
        return view('backend.pages.offer.addproducts', compact('products', 'offer') );


    }

    public function edit($id)
    {
        $offer = Offer::find($id);
        return view('backend.pages.offer.edit', compact('offer') );
    }

    public function update(Request $request, $id)
    {
        $offer = Offer::find($id);
        $offer->name = $request->name;
        $offer->start = $request->start;
        $offer->end = $request->end;
        if ($request->continue == 1) {
            $offer->continue = $request->continue;
        }
        else {
            $offer->continue = Null;
        }
        
        $offer->save();

        return redirect()->route('admin.offers');

    }
}
