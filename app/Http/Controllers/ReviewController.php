<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Product;

class ReviewController extends Controller
{
     public function createByUser(Request $request)
    {
    	$review = new Review;
    	$product_id = $request->product_id;
    	$user_email = $request->user_email;
		$product = Product::find($product_id);
		if (!is_null($product)) {
			if (!is_null($product->vendor_id)) {
				$vendor_id = $product->vendor_id;
			}
			else {
				$vendor_id = Null;
			}
			
		} else {
			session()->flash('danger',"We couldn't find this product.");
			return back();
		}
    	$checkduplicatereveiw = Review::orderBy('id','asc')->where('product_id', $product_id)->where('user_email', $user_email)->first();

    	if (!empty($checkduplicatereveiw)) {
    		$review = Review::find($checkduplicatereveiw->id);
			$review->product_id = $request->product_id;
			$review->vendor_id = $vendor_id;
    		$review->user_name = $request->user_name;
    		$review->user_email = $request->user_email;
    		$review->user_message = $request->user_message;
    		$review->rating = $request->rating;

    	}else {
			$review->product_id = $request->product_id;
			$review->vendor_id = $vendor_id;
    		$review->user_name = $request->user_name;
    		$review->user_email = $request->user_email;
    		$review->user_message = $request->user_message;
    		$review->rating = $request->rating;
    	}

    	$review->save();

    	session()->flash('success', 'Review has been added successfully!!');
    	return back();

    }



}
