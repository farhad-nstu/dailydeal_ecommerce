<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Attribute;
use App\AttributeSet;

class AttributeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function create()
    {
    	return view('backend.pages.attribute.create');
    }
    public function store(Request $request)
    {

    	$request->validate([
    		'name' => 'required|max:150',
    		'options' => 'required',
    		
    	]);
    	
    	$attribute = new Attribute;

    	$attribute->name = $request->name;

    	$options = explode(',', $request->options);
    	$options = serialize($options);

    	$attribute->options = $options;

    	$attribute->save();


    	return redirect()->route('admin.attribute.create');


    	
    }

    public function manage()
    {

    	$attributes = Attribute::orderBy('name','asc')->get();
    	return view('backend.pages.attribute.index', compact('attributes'));
    }

    public function edit($id)
    {
    	$attribute = Attribute::find($id);
    	return view('backend.pages.attribute.edit', compact('attribute'));
    }

    public function update(Request $request, $id)
    {

    	
    	$request->validate([
    		'name' => 'required|max:150',
    		'options' => 'required',
    		
    	]);
    	
    	$attribute = Attribute::find($id);

    	$attribute->name = $request->name;

    	$options = explode(',', $request->options);
    	$options = serialize($options);

    	$attribute->options = $options;

    	$attribute->save();


    	return redirect()->route('admin.attributes');
    	
    }

    public function delete($id)
    {
    	$attribute = Attribute::find($id);

        $attributesets = AttributeSet::orderBy('id','asc')->get();

        foreach ($attributesets as $attributeset) {
            //Attribute id in attributes set
            $attribute_ids = $attributeset['attribute_id'];
            $attribute_ids = unserialize($attribute_ids);

            foreach ($attribute_ids as $attribute_id) {
                if ($attribute_id == $id) {

                    $attributesetneedtoupdate = AttributeSet::find($attributeset['id']);

                    $attribute_id_array = unserialize($attributesetneedtoupdate->attribute_id); 

                    if (count($attribute_id_array) == 1) {
                        $attributesetneedtoupdate->delete();
                    }
                    else{

                    $arraytostring = implode(',', $attribute_ids);
                    $stringreplace = str_replace(",$attribute_id", '', $arraytostring);
                    $updatedattribute_ids = explode(',', $stringreplace);
                    $serialize_updatedattribute_ids = serialize($updatedattribute_ids);


                    $attributesetneedtoupdate->attribute_id = $serialize_updatedattribute_ids;
                    $attributesetneedtoupdate->save();
                    }

                }
                
            }
        }

    	$attribute->delete();

    	session()->flash('success', 'Attribute has been deleted successfully!!');
    	return back();
    }
}
