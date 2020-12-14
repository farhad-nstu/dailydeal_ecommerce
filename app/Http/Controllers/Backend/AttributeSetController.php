<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\AttributeSet;
use App\Attribute;

class AttributeSetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function create()
    {
    	$attributes = Attribute::orderBy('name','asc')->get();
    	return view('backend.pages.attribute_set.create',compact('attributes'));
    }
    public function store(Request $request)
    {

    	$request->validate([
    		'name' => 'required|max:150',
    		'attribute' => 'required',
    		
    	]);
    	
    	$attributeset = new AttributeSet;

    	$attributes = serialize($request->attribute);



    	$attributeset->name = $request->name;
    	$attributeset->attribute_id = $attributes;


    	$attributeset->save();


    	return redirect()->route('admin.attributeSet.create');


    	
    }

    public function manage()
    {

    	$attributesets = AttributeSet::orderBy('name','asc')->get();
    	return view('backend.pages.attribute_set.index', compact('attributesets'));
    }

    public function edit($id)
    {
    	$attributes = Attribute::orderBy('name','asc')->get();
    	$attribute_set = AttributeSet::find($id);   	
    	return view('backend.pages.attribute_set.edit', compact('attribute_set', 'attributes'));
    }

    public function update(Request $request, $id)
    {

    	
    	$request->validate([
    		'name' => 'required|max:150',
    		'attribute' => 'required',
    		
    	]);
    	
    	$attributeset = AttributeSet::find($id);

    	$attributes = serialize($request->attribute);



    	$attributeset->name = $request->name;
    	$attributeset->attribute_id = $attributes;


    	$attributeset->save();

    	session()->flash('success', 'Attribute Set has been updated successfully!!');

    	return redirect()->route('admin.attributeSets');

    	
    }

    public function delete($id)
    {
    	$attributeset = Category::find($id);
    	$attributeset->delete();

    	session()->flash('success', 'Category has been deleted successfully!!');
    	return back();
    }
}
