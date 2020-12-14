<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Review;
use App\Product;
use Auth;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:vendor');
    }

    public function manage()
    {
        $reviews = Review::orderBy('id','desc')->where('vendor_id', Auth::user()->id)->get();

    	return view('backend.vendor.review.index',compact('reviews'));

    }
}
