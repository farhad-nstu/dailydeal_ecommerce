<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Page;


class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    
    public function create()
    {
    	return view('backend.pages.page.create');
    }

    public function store(Request $request)
    {
    	$request->validate([
    		'title' => 'required|max:150',
    		
    	]);

    	$page = new Page;
    	$page->title = $request->title;
    	$page->title_bd = $request->title_bd;

    	$new_slug= Str::slug($request->title,'-');

        $checkifsameslughas = Page::orWhere('slug','like','%'.$new_slug.'%')->get();
        if (count($checkifsameslughas) > 0) {
            $slug_last_value = count($checkifsameslughas)+1;
            $final_slug = $new_slug."-".$slug_last_value;
            $page->slug = $final_slug;
        }
        else {
            $page->slug = $new_slug;
        }

        $page->content = $request->content;
        $page->content_bd = $request->content_bd;

        $page->save();

        session()->flash('success', 'Page Created Successfully');

        return back();



    }

    public function manage()
    {
    	$pages = Page::orderBy('title','asc')->get();

    	return view('backend.pages.page.index', compact('pages'));
    }

    public function edit($id)
    {
    	$page = Page::find($id);

    	return view('backend.pages.page.edit', compact('page'));
    }


    public function update(Request $request, $id)
    {
    	$request->validate([
    		'title' => 'required|max:150',
    		
    	]);

    	$page = Page::find($id);
    	$page->title = $request->title;
    	$page->title_bd = $request->title_bd;


        $page->content = $request->content;
        $page->content_bd = $request->content_bd;

        $page->save();

        session()->flash('success', 'Page Updated Successfully');

        return back();

    }



    public function delete($id)
    {
    	$page = Page::find($id);

    	if (!is_null($page)) {
    		$page->delete();
    	}

    	session()->flash('success', 'Page has been deleted successfully!!');
    	return back();
    }
}
