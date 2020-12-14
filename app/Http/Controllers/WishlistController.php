<?php

namespace App\Http\Controllers;
use Auth;
use App\Wishlist;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function store($id)
    {
    	if (!Auth::check()) {
    		session()->flash('success', 'Please login for add wishlist');
    		return redirect()->route('login');
    	}
    	else {
    		$wishlist = new Wishlist;
    		$wishlist->user_id = Auth::user()->id;
    		$wishlist->product_id = $id;
    		$wishlist->save();
    		session()->flash('success', 'Product added to wishlist successfully');
    		return back();
    	}
    }

    public function index()
    {
    	if (!Auth::check()) {
    		session()->flash('success', 'Please login for add wishlist');
    		return redirect()->route('login');
    	}

    	$wishlists = Wishlist::where('user_id', Auth::user()->id)->paginate(10);

    	return view('frontend.pages.user.wishlists', compact('wishlists'));
    }

    public function delete($id)
    {
    	if (!Auth::check()) {
    		session()->flash('success', 'Please login for add wishlist');
    		return redirect()->route('login');
    	}

    	$wishlist = Wishlist::find($id);

    	if (!is_null($wishlist)) {
    		$wishlist->delete();
    	}

    	session()->flash('success', 'This item removed.');
    	return back();
    }
}
