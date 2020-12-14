<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Harimayco\Menu\Facades\Menu;
use Harimayco\Menu\Models\Menus;
use Harimayco\Menu\Models\MenuItems;

class WpmenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    
    public function wpmenubdstore(Request $request)
    {
        $wpmenu = Menus::find($request->idmenu);
        $wpmenu->name_bd = $request->menuname_bd;
        $wpmenu->save();
        return back();
    }

    public function wpmenuoptionbdstore(Request $request)
    {
        $menu_option = MenuItems::find($request->menu_option_id);
        $menu_option->label_bd = $request->menuname_items_bd;
        $menu_option->save();
        return back();
    }


    public function wpmenulocation(Request $request)
    {
        $menu = Menus::find($request->menu_id);
        $menu_locations = $request->menu_locations;
        $menu->location = serialize($menu_locations);

        $menu->save();
        return back();
    }
}
