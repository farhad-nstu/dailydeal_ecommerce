@php
use App\General;
use App\Category;
use App\Menu;
use App\Product;

$general = General::find(1);
$categories = Category::orderBy('name', 'asc')->get();
$menus = Menu::orderBy('id', 'asc')->get();
$products = Product::orderBy('id','desc')->get();

@endphp