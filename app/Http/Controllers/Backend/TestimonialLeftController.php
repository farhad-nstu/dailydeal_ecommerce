<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\TestimonialLeft;

class TestimonialLeftController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    
    public function update(Request $request, $id)
    {
    	$testmonialleft = TestimonialLeft::find($id);
    	$testmonialleft->title = $request->title;
    	$testmonialleft->title_bd = $request->title_bd;
    	$testmonialleft->description = $request->description;
    	$testmonialleft->description_bd = $request->description_bd;
    	$testmonialleft->save();

    	session()->flash('success','Updated successfully.');
    	return back();
    }
}
