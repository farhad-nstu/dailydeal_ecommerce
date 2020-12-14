<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Menu;



class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    
    public function create()
    {
    	return view('backend.pages.menu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:150',
            'route' => 'required',
            
        ]);

        $menus = new Menu;
        $menus->name = $request->name;
        $menus->name_bd = $request->name_bd;
        $menus->route = $request->route;
        $menus->menu_location = $request->menu_location;

        $menus->save();
        session()->flash('success', 'Menu created successfully!!');
        return back();
    }

    public function manage()
    {
        $menus = Menu::orderBy('id','asc')->get();
        return view('backend.pages.menu.index', compact('menus'));
    }

    public function edit($id)
    {
        $menu = Menu::find($id);
        return view('backend.pages.menu.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
        'name' => 'required|max:150',
        'route' => 'required',
            
        ]);

        $menus = Menu::find($id);
        $menus->name = $request->name;
        $menus->name_bd = $request->name_bd;
        $menus->route = $request->route;
        $menus->menu_location = $request->menu_location;

        $menus->save();
        session()->flash('success', 'Menu update successfully!!');
        return back();
    }

    public function delete($id)
    {
        $menu = Menu::find($id);

        if (!is_null($menu)) {
            $menu->delete();
        }

        session()->flash('success', 'Menu has been deleted successfully!!');
        return back();
    }


    public function wpmenu()
    {
        return view('backend.pages.menu.wpmenu');
    }

    

}
