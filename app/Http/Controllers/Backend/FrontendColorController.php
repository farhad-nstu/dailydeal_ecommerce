<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\FrontendColor;

class FrontendColorController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function edit()
    {
    	return view('backend.pages.general.color');
    }

    public function update(Request $request, $name)
    {
    	$frontendcolor = FrontendColor::find(1);
    	if ($name == 'primary') {
    		$frontendcolor->primary = $request->color;
    	}
    	elseif($name == 'secondary'){
    		$frontendcolor->secondary = $request->color;
    	}
    	elseif($name == 'tertiary'){
    		$frontendcolor->tertiary = $request->color;
    	}
    	elseif($name == 'quaternary'){
    		$frontendcolor->quaternary = $request->color;
    	}
        elseif($name == 'fifth'){
            $frontendcolor->fifth = $request->color;
        }
    	elseif($name == 'body'){
            $frontendcolor->body = $request->color;
        }
        
    	$frontendcolor->save();
    	session()->flash('success', 'color updated successfully');
    	return back();
    }
}
