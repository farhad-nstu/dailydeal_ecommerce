<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/checkout','Frontend\ApiController@checkout');

Route::get('/userinfo/{id}','Frontend\ApiController@userinfo');

Route::get('/productsimage/{id}','Frontend\ApiController@productimage');

Route::get('/products','Frontend\ProductController@apiIndex');

Route::get('/slider','Frontend\ApiController@slider');

Route::get('/banner','Frontend\ApiController@banner');

Route::get('/home','Frontend\ApiController@index');

Route::get('/product/{slug}','Frontend\ApiController@show');

Route::post('/otp/activation','Frontend\ApiController@otpactivation');

// Route::get('/tracking','Frontend\ApiController@tracking');

Route::post('/tracking/search','Frontend\ApiController@trackingSearch');

Route::get('/category/newest/{id}','Frontend\ApiController@categorynewestShort');

Route::get('/categoryAll','Frontend\ApiController@getAllCategory');

Route::get('/category/priceasc/{id}','Frontend\ApiController@categorypriceasc');

Route::get('/category/pricedesc/{id}','Frontend\ApiController@categorypricedesc');

Route::get('/category/showamount/{number}/{id}','Frontend\ApiController@categoryshowamount');

Route::post('/category/price/','Frontend\ApiController@categorypricShort');

Route::get('/category/color/{code}/{id}','Frontend\ApiController@categorycolorShort');

Route::get('/category/color/{sizecode}/{id}','Frontend\ApiController@categorysizeShort');

Route::get('/category/{brand_id}/{category_id}','Frontend\ApiController@categorybrandShort');

Route::get('/category/all/products/{category_id}','Frontend\ApiController@allProductsByCategoryId');

/// Page ///
Route::get('/page/{slug}','Frontend\ApiController@showPage');

Route::get('/category/{slug}','Frontend\ApiController@categorySingle');

Route::get('/brand/{id}','Frontend\ApiController@brandSingle');

Route::get('/offer/{slug}','Frontend\ApiController@offer');

Route::post('/search/','Frontend\ApiController@search');

Route::post('/review_add','Frontend\ApiController@createByUser');

Route::get('/orderss/{id}','Frontend\ApiController@orders');

///// User Profile //// 
Route::group(['prefix'=> 'user'], function() {

	Route::group(['prefix'=> 'profile'], function() {

		Route::get('/myaccounts','Frontend\ApiController@showMyaccounts');
		Route::post('/myaccounts/','Frontend\ApiController@profileupdate');
		Route::get('/orders/{id}','Frontend\ApiController@orders');
		Route::get('order/action/{id}/status/{action}/{user_id}','Frontend\ApiController@orderaction');
		Route::post('orders/search','Frontend\ApiController@ordersearch');
		
	});

	Route::get('/wishlists/','Frontend\ApiController@wishlistIndex');
	Route::get('/wishlists/delete/{id}','Frontend\ApiController@delete');
	Route::get('/wishlists/add/{id}','Frontend\ApiController@wishlistStore');
	
});

////// Rgiser and Login //////
    Route::get('register/form', 'Frontend\ApiController@showRegistrationForm');
    Route::post('register', 'Frontend\ApiController@register');
    //Route::get('login', 'Frontend\ApiController@showLoginForm');
    Route::post('login', 'Frontend\ApiController@login');
    Route::get('logout', 'Frontend\ApiController@logout');
    
    
    ////// Cart //////
Route::group(['prefix'=> 'carts'], function() {

	//carts
// 	Route::get('/','Frontend\CartsController@cart_index');
	Route::post('/store','Frontend\ApiController@store_cart_data');
	Route::get('/ajax/store','Frontend\ApiController@ajaxstore');
	Route::get('/updatequantity/{id}/action/{action}/{dd}','Frontend\ApiController@updatequantity');

	Route::get('/updatequantity/delete/{id}','Frontend\ApiController@delete_quantity');
	Route::get('/addshipping/{city}','Frontend\ApiController@addShipping');

	
});


///// Cart end ////



