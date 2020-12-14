<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Review;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    
    public function manage()
    {
    	$reviews = Review::orderBy('id','desc')->get();

    	return view('backend.pages.review.index',compact('reviews'));

    }

    public function edit($id)
    {
    	$review = Review::find($id);
    	return view('backend.pages.review.edit',compact('review'));
    }
    public function update(Request $request, $id)
    {
    	$review = Review::find($id);
		$review->user_name = $request->user_name;
		$review->user_email = $request->user_email;
		$review->user_message = $request->user_message;
		$review->rating = $request->rating;

		$review->save();
		session()->flash('success', 'Review has been updated successfully');
		return redirect()->route('admin.reviews');
    }

    public function approve($id)
    {
    	$review = Review::find($id);
    	if ($review->status == 0) {
    		$review->status = 1;
    	}
    	elseif ($review->status == 1) {
    		$review->status = 0;
    	}

    	$review->save();
    	session()->flash('success', 'Success');
    	return redirect()->route('admin.reviews');
    }

    public function delete($id)
    {
    	$review = Review::find($id);
    	
    	if (!is_null($review)) {
    		$review->delete();
    	}

    	session()->flash('success', 'Review has been deleted successfully!!');
    	return back();
    }

}
