<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Storage;
use Illuminate\Http\Request;
use App\Font;
use Illuminate\Support\Str;
use App\Css;

class FontController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function edit()
    {
    	return view('backend.pages.general.font');
    }
    public function store(Request $request)
    {
    	$font = new Font;
    	$file = $request->font;

    	if(!empty($file)) :
		      $name = $file->getClientOriginalName();
		      $name = str_replace(" ","-",$name);
		      $filename = pathinfo($name, PATHINFO_FILENAME);
		      //check if font exists
		      $check = Font::where('font_name', $filename)->first();
		      if (!is_null($check)) {
		      	$check->delete();
		      }

		      $location = Storage::disk('public_uploads')->putFileAs(
			    'assets/fonts', $file,$name
			  );
			  
			  $font->font_name = $filename;
			  $font->font_location = $location;
			  $font->save();


		endif;

		session()->flash('success','Font added successfully.');
		return back();

		//get file
		//file_get_contents('public/assets/fonts/Roboto-Bold.ttf');

        
    }
    

    public function update($id)
    {
    	$font = Font::find($id);
    	if ($font->status == 0) {
    		$font->status = 1;
    	}
    	else {
            $font->status = 0;
        }
    	$font->save();

    	session()->flash('success', 'Success');
    	return back();
    }

    public function cssupdate(Request $request)
    {
        $css = Css::find(1);

        if (isset($request->body_font)) {
         $css->body = $request->body_font;
        }
        if (isset($request->menu_font)) {
         $css->menu = $request->menu_font;
        }
        if (isset($request->heading_font)) {
         $css->heading = $request->heading_font;
        }

        $css->save();
        session()->flash('success','Font updated successfully.');
        return back();
        
    }
}
