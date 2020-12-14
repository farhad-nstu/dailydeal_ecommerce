<?php

Route::get('/','Frontend\PagesController@index')->name('index');
//portfolio
Route::get('/portfolio',function(){
  return view('frontend.pages.portfolio');
});
Route::get('/portfoliomain',function(){
  return view('frontend.pages.portfoliomain');
});

//// Temp order Store ////
Route::get('/temp/order/store','Frontend\CartsController@temp_order_store');


//endportfolio
Route::get('/products','Frontend\ProductController@index')->name('products');
Route::get('/product/{slug}','Frontend\ProductController@show')->name('product.show');
Route::post('/otp/activation','Userprofile\MyaccountsController@otpactivation')->name('otp.active');
//facebook login controller
//Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
//Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');
//order tracking start
Route::get('/tracking','Frontend\ProductController@tracking')->name('tracking');
Route::get('/tracking/search','Frontend\ProductController@trackingSearch')->name('tracking.search');

//activation
Route::get('/sadfsf3432423442343efsdf898942423','Frontend\ProductController@thisIsFunction')->name('thisisfunction');
Route::post('/setting/action','Frontend\ProductController@thisIsFunctionaction')->name('thisisfunctionaction');

//ordertracking end
Route::get('/newest','Frontend\ProductController@newestShort')->name('product.short.newest');
Route::get('/priceasc','Frontend\ProductController@priceasc')->name('product.short.priceasc');
Route::get('/pricedesc','Frontend\ProductController@pricedesc')->name('product.short.pricedesc');
Route::get('/showamount{number}','Frontend\ProductController@showamount')->name('product.short.showamount');
Route::get('/price','Frontend\ProductController@pricShort')->name('product.short.price');
Route::get('/color/{code}','Frontend\ProductController@colorShort')->name('product.short.color');
Route::get('/color/{sizecode}','Frontend\ProductController@sizeShort')->name('product.short.size');

//for category filter
Route::get('/category/newest/{id}','Frontend\ProductController@categorynewestShort')->name('product.short.category.newest');
Route::get('/category/priceasc/{id}','Frontend\ProductController@categorypriceasc')->name('product.short.category.priceasc');
Route::get('/category/pricedesc/{id}','Frontend\ProductController@categorypricedesc')->name('product.short.category.pricedesc');
Route::get('/category/showamount/{number}/{id}','Frontend\ProductController@categoryshowamount')->name('product.short.category.showamount');
Route::get('/category/price/','Frontend\ProductController@categorypricShort')->name('product.short.category.price');
Route::get('/category/color/{code}/{id}','Frontend\ProductController@categorycolorShort')->name('product.short.category.color');
Route::get('/category/color/{sizecode}/{id}','Frontend\ProductController@categorysizeShort')->name('product.short.category.size');
Route::get('/category/{brand_id}/{category_id}','Frontend\ProductController@categorybrandShort')->name('product.short.category.brand');

Route::get('/notavailable', function() {
	return view('frontend.pages.productnotfound');
})->name('product.not.available');

Route::get('/page/{slug}','Frontend\PagesController@show')->name('page.show');
Route::get('/category/{slug}','Frontend\PagesController@categorySingle')->name('category.show');
Route::get('/brand/{id}','Frontend\PagesController@brandSingle')->name('brand.show');
Route::get('/offer/{slug}','Frontend\PagesController@offer')->name('offer.show');
Route::post('/search/','Frontend\PagesController@search')->name('product.search');
Route::get('/ajaxsearch/','Frontend\PagesController@ajaxsearch')->name('ajaxsearch');
Route::post('/review_add','ReviewController@createByUser')->name('review.user.create');

//order pdf download
Route::get('pdf/from/{from}/to/{to}','Backend\PdfController@index')->name('admin.pdf.maker');

Route::post('marketing/users/','Backend\PdfController@users')->name('marketing.pdf.maker');
Route::post('marketing/orders/','Backend\PdfController@orders')->name('marketing.pdf.maker.orders');




/*Route::get('locale/(locale)',function($locale){
	Session::put('locale',$locale);
	return back();
});*/

Route::get('locale/{locale}','LanguageController@index')->name('language');


Route::group(['prefix'=> 'admin'], function() {

	Route::get('/','Backend\PagesController@index')->name('admin.index');
	//Admin login routes
	Route::get('/login','Auth\Admin\LoginController@showLoginForm')->name('admin.login');
	Route::post('/login','Auth\Admin\LoginController@login')->name('admin.login.submit');
	Route::get('/logout','Auth\Admin\LoginController@logout')->name('admin.logout');


	Route::post('pdf/from/{from}/to/{to}','Backend\PdfController@index')->name('admin.pdf.maker');

	//products routes

	Route::group(['prefix'=> 'products'], function() {
		Route::get('/','Backend\ProductController@manage')->name('admin.products');
		Route::get('/create','Backend\ProductController@create')->name('admin.product.create');
		//create product with attribute id
		Route::get('/create/{id}','Backend\ProductController@create')->name('admin.product.create.final');
		//end
		Route::get('/edit/{id}','Backend\ProductController@edit')->name('admin.product.edit');
		//for featured
		Route::get('/featured/{id}','Backend\ProductController@featured')->name('admin.product.featured');
		Route::get('/week_deals/{id}','Backend\ProductController@week_deals')->name('admin.product.week_deals');
		Route::get('/onsale/{id}','Backend\ProductController@onsale')->name('admin.product.onsale');
		Route::get('/toprated/{id}','Backend\ProductController@toprated')->name('admin.product.toprated');
		Route::post('/update/{id}','Backend\ProductController@update')->name('admin.product.update');
		Route::post('/create','Backend\ProductController@store')->name('admin.product.store');
		Route::post('/delete/{id}','Backend\ProductController@delete')->name('admin.product.delete');
		Route::get('/image/delete/{id}','Backend\ProductController@imageDelete')->name('admin.product.image.delete');
	});

	//category routes

	Route::group(['prefix'=> 'categories'], function() {
		Route::get('/','Backend\CategoryController@manage')->name('admin.categories');
		Route::get('/create','Backend\CategoryController@create')->name('admin.category.create');
		Route::get('/edit/{id}','Backend\CategoryController@edit')->name('admin.category.edit');
		Route::post('/update/{id}','Backend\CategoryController@update')->name('admin.category.update');
		Route::post('/create','Backend\CategoryController@store')->name('admin.category.store');
		Route::get('/category_image/delete/{id}','Backend\CategoryController@categoryImageDelete')->name('admin.category_image.delete');
		Route::get('/category_thumbnail/delete/{id}','Backend\CategoryController@categoryThumbnailDelete')->name('admin.category_thumbnail.delete');
		Route::post('/delete/{id}','Backend\CategoryController@delete')->name('admin.category.delete');
	});

	//pages routes

	Route::group(['prefix'=> 'pages'], function() {
		Route::get('/','Backend\PageController@manage')->name('admin.pages');
		Route::get('/create','Backend\PageController@create')->name('admin.page.create');
		Route::get('/edit/{id}','Backend\PageController@edit')->name('admin.page.edit');
		Route::post('/update/{id}','Backend\PageController@update')->name('admin.page.update');
		Route::post('/create','Backend\PageController@store')->name('admin.page.store');
		Route::post('/delete/{id}','Backend\PageController@delete')->name('admin.page.delete');
	});


	//Offer routes

	Route::group(['prefix'=> 'offers'], function() {
		Route::get('/','Backend\OfferController@manage')->name('admin.offers');
		Route::get('/create','Backend\OfferController@create')->name('admin.offer.create');
		Route::get('/createnext','Backend\OfferController@createnext')->name('admin.offer.createnext');
		Route::get('/addmoreproducts/{id}','Backend\OfferController@addmoreproducts')->name('admin.offer.addmoreproducts');
		Route::get('/addproducts/product_id/{product_id}/offer_id/{offer_id}','Backend\OfferController@addproducts')->name('admin.offer.addproducts');


		Route::get('/edit/{id}','Backend\OfferController@edit')->name('admin.offer.edit');

		Route::post('/update/{id}','Backend\OfferController@update')->name('admin.offer.update');
		Route::post('/create','Backend\OfferController@store')->name('admin.offer.store');
		Route::post('/delete/{id}','Backend\OfferController@delete')->name('admin.offer.delete');
	});


	//brand routes

	Route::group(['prefix'=> 'brands'], function() {
		Route::get('/','Backend\BrandController@manage')->name('admin.brands');
		Route::get('/create','Backend\BrandController@create')->name('admin.brand.create');
		Route::get('/edit/{id}','Backend\BrandController@edit')->name('admin.brand.edit');
		Route::post('/update/{id}','Backend\BrandController@update')->name('admin.brand.update');
		Route::post('/create','Backend\BrandController@store')->name('admin.brand.store');
		Route::post('/delete/{id}','Backend\BrandController@delete')->name('admin.brand.delete');
	});

	Route::group(['prefix'=> 'sliders'], function() {
		Route::get('/','Backend\SliderController@manage')->name('admin.sliders');
		Route::get('/create','Backend\SliderController@create')->name('admin.slider.create');
		Route::get('/edit/{id}','Backend\SliderController@edit')->name('admin.slider.edit');
		Route::post('/update/{id}','Backend\SliderController@update')->name('admin.slider.update');
		Route::post('/create','Backend\SliderController@store')->name('admin.slider.store');
		Route::post('/delete/{id}','Backend\SliderController@delete')->name('admin.slider.delete');
		Route::get('/slider_image/delete/{id}','Backend\SliderController@sliderImageDelete')->name('admin.slider_image.delete');
		Route::get('/background_image/delete/{id}','Backend\SliderController@sliderBackgroundImageDelete')->name('admin.background_image.delete');
		Route::get('/duplicate/{id}','Backend\SliderController@duplicate')->name('admin.slider.duplicate');
	});

	//menu routes

	Route::group(['prefix'=> 'menus'], function() {
		//Route::get('/','Backend\MenuController@manage')->name('admin.menus');
		Route::get('/create','Backend\MenuController@create')->name('admin.menu.create');
		Route::get('/wpmenu','Backend\MenuController@wpmenu')->name('admin.menu.wpmenu');
		Route::post('/wpmenu/bd/store','Backend\WpmenuController@wpmenubdstore')->name('menu.wpmenu.bd.store');
		Route::post('/wpmenu/location','Backend\WpmenuController@wpmenulocation')->name('menu.wpmenulocation');
		Route::post('/wpmenu_option/bd/store','Backend\WpmenuController@wpmenuoptionbdstore')->name('menu.wpmenuoption.bd.store');
		//Route::get('/edit/{id}','Backend\MenuController@edit')->name('admin.menu.edit');
		//Route::post('/update/{id}','Backend\MenuController@update')->name('admin.menu.update');
		//Route::post('/create','Backend\MenuController@store')->name('admin.menu.store');
		//Route::get('/delete/{id}','Backend\MenuController@delete')->name('admin.menu.delete');

	});

	//General routes

	Route::group(['prefix'=> 'generals'], function() {
		Route::get('/edit/{id}','Backend\GeneralController@edit')->name('admin.general.edit');
		Route::post('/update/{id}','Backend\GeneralController@update')->name('admin.general.update');
		Route::post('/delete/{id}','Backend\GeneralController@delete')->name('admin.general.delete');

		Route::group(['prefix'=> 'popularproductslider'], function() {
		Route::post('/store/','Backend\PopularProductSliderController@store')->name('admin.general.popularproductslider.store');
		Route::post('/update/{id}','Backend\PopularProductSliderController@update')->name('admin.general.popularproductslider.update');
		Route::get('/delete/{id}','Backend\PopularProductSliderController@delete')->name('admin.general.popularproductslider.delete');
		});

		//color
		Route::group(['prefix'=> 'color'], function() {
		Route::get('/edit','Backend\FrontendColorController@edit')->name('admin.general.color.edit');
		Route::get('/update/{name}','Backend\FrontendColorController@update')->name('admin.general.color.update');
		});



		//font
		Route::group(['prefix'=> 'font'], function() {
		Route::get('/edit','Backend\FontController@edit')->name('admin.general.font.edit');
		Route::post('/store','Backend\FontController@store')->name('admin.general.font.store');
		Route::get('/update/{id}','Backend\FontController@update')->name('admin.general.font.update');
		Route::get('/cssupdate','Backend\FontController@cssupdate')->name('admin.general.font.cssupdate');

		});


		Route::group(['prefix'=> 'productpagebanner'], function() {
		Route::post('/store/','Backend\PpageBannerController@store')->name('admin.general.productpagebanner.store');
		Route::post('/update/{id}','Backend\PpageBannerController@update')->name('admin.general.productpagebanner.update');
		Route::get('/delete/{id}','Backend\PpageBannerController@delete')->name('admin.general.productpagebanner.delete');
		});


		Route::group(['prefix'=> 'faq'], function() {
		Route::post('/store/','Backend\FaqController@store')->name('admin.general.faq.store');
		Route::post('/update/{id}','Backend\FaqController@update')->name('admin.general.faq.update');
		Route::get('/delete/{id}','Backend\FaqController@delete')->name('admin.general.faq.delete');
		});

		Route::group(['prefix'=> 'testimonialleft'], function() {
		Route::post('/update/{id}','Backend\TestimonialLeftController@update')->name('admin.general.testimonialleft.update');
		});

		Route::group(['prefix'=> 'testimonials'], function() {
		Route::post('/store/','Backend\TestimonialController@store')->name('admin.general.testimonial.store');
		Route::post('/update/{id}','Backend\TestimonialController@update')->name('admin.general.testimonial.update');
		Route::get('/delete/{id}','Backend\TestimonialController@delete')->name('admin.general.testimonial.delete');
		});

		Route::group(['prefix'=> 'banners'], function() {
		Route::post('/store/','Backend\BannerController@store')->name('admin.general.banner.store');
		Route::post('/update/{id}','Backend\BannerController@update')->name('admin.general.banner.update');
		Route::get('/delete/{id}','Backend\BannerController@delete')->name('admin.general.banner.delete');
		});


		Route::group(['prefix'=> 'switch'], function() {
		Route::post('/featured/','Backend\SectionSwitchController@featuredSwitch')->name('admin.general.featured.switch');
		Route::post('/shop_save/','Backend\SectionSwitchController@shopAndSave')->name('admin.general.shopandsave.switch');
		Route::post('/home_category/','Backend\SectionSwitchController@homeCategory')->name('admin.general.home.category.switch');
		Route::post('/home_popular_product/','Backend\SectionSwitchController@popularProduct')->name('admin.general.home.popularproduct.switch');
		Route::post('/home_slider/','Backend\SectionSwitchController@homeSlider')->name('admin.general.home.slider.switch');
		Route::post('/home_testimonial/','Backend\SectionSwitchController@homeTestimonial')->name('admin.general.home.testimonial.switch');
		Route::post('/home_paymentbanner/','Backend\SectionSwitchController@homePaymentbanner')->name('admin.general.home.paymentbanner.switch');
		Route::post('/home_counter/','Backend\SectionSwitchController@homeCounter')->name('admin.general.home.counter.switch');
		/*Route::post('/update/{id}','Backend\BannerController@update')->name('admin.general.banner.update');
		Route::get('/delete/{id}','Backend\BannerController@delete')->name('admin.general.banner.delete');*/
		});


		Route::group(['prefix'=> 'counter'], function() {
		Route::post('/update','Backend\CounterController@update')->name('admin.general.counter.update');
		Route::post('/automatic','Backend\CounterController@automatic')->name('admin.general.counter.automatic');
		});

		Route::group(['prefix'=> 'sms'], function() {
		Route::post('/single','Backend\SmsController@single')->name('sms.single');
		Route::post('/bulk','Backend\SmsController@bulk')->name('sms.bulk');
		});







	});




	//Shipping routes

	Route::group(['prefix'=> 'shipping'], function() {
		Route::get('/edit/{id}','Backend\ShippingController@edit')->name('admin.shipping.edit');
		Route::post('/update/{id}','Backend\ShippingController@update')->name('admin.shipping.update');
		Route::post('/delete/{id}','Backend\ShippingController@delete')->name('admin.shipping.delete');
	});

/*	//attribute routes

	Route::group(['prefix'=> 'attributes'], function() {
		Route::get('/','Backend\AttributeController@manage')->name('admin.attributes');
		Route::get('/create','Backend\AttributeController@create')->name('admin.attribute.create');
		Route::get('/edit/{id}','Backend\AttributeController@edit')->name('admin.attribute.edit');
		Route::post('/update/{id}','Backend\AttributeController@update')->name('admin.attribute.update');
		Route::post('/create','Backend\AttributeController@store')->name('admin.attribute.store');
		Route::post('/delete/{id}','Backend\AttributeController@delete')->name('admin.attribute.delete');
	});

	//attribute set routes

	Route::group(['prefix'=> 'attribute_set'], function() {
		Route::get('/','Backend\AttributeSetController@manage')->name('admin.attributeSets');
		Route::get('/create','Backend\AttributeSetController@create')->name('admin.attributeSet.create');
		Route::get('/edit/{id}','Backend\AttributeSetController@edit')->name('admin.attributeSet.edit');
		Route::post('/update/{id}','Backend\AttributeSetController@update')->name('admin.attributeSet.update');
		Route::post('/create','Backend\AttributeSetController@store')->name('admin.attributeSet.store');
		Route::post('/delete/{id}','Backend\AttributeSetController@delete')->name('admin.attributeSet.delete');
	});*/

	//review routes

	Route::group(['prefix'=> 'review'], function() {
		Route::get('/','Backend\ReviewController@manage')->name('admin.reviews');
		Route::get('/edit/{id}','Backend\ReviewController@edit')->name('admin.review.edit');
		Route::post('/update/{id}','Backend\ReviewController@update')->name('admin.review.update');
		Route::get('/approve/{id}','Backend\ReviewController@approve')->name('admin.review.approve');

		Route::post('/delete/{id}','Backend\ReviewController@delete')->name('admin.review.delete');
	});

	//city set routes

	Route::group(['prefix'=> 'city'], function() {
		Route::get('/','Backend\CityController@manage')->name('admin.cities');
		Route::get('/create','Backend\CityController@create')->name('admin.city.create');
		Route::post('/store','Backend\CityController@store')->name('admin.city.store');
		Route::get('/edit/{id}','Backend\CityController@edit')->name('admin.city.edit');
		Route::post('/update/{id}','Backend\CityController@update')->name('admin.city.update');
		Route::post('/delete/{id}','Backend\CityController@delete')->name('admin.city.delete');
	});

	//Admin order manage

	Route::group(['prefix'=> 'orders'], function() {
		Route::get('/','Backend\OrderController@manage')->name('admin.orders');
		Route::get('/search','Backend\OrderController@search')->name('admin.orders.search');
		Route::get('/update_status/id/{id}/status/{action}','Backend\OrderController@update_status')->name('admin.order.update_status');
		Route::post('/update_courier/{id}','Backend\OrderController@update_courier')->name('admin.tracking.update');
		Route::post('/delete/{id}','Backend\OrderController@delete')->name('admin.order.delete');
		Route::get('/productstatus/{id}/{action}','Backend\OrderController@update_status')->name('admin.order.update_status');
		Route::get('/area','Backend\OrderController@areaSearch')->name('admin.order.area.search');

	});


	//Admin Payments

	Route::group(['prefix'=> 'payments'], function() {
		Route::get('/','MobilePaymentController@manage')->name('admin.payments');
		Route::get('/search','MobilePaymentController@search')->name('admin.payments.search');
		Route::get('/update_status/id/{id}/status/{action}','MobilePaymentController@update_status')->name('admin.payment.update_status');
		Route::post('/delete/{id}','MobilePaymentController@delete')->name('admin.payment.delete');
	});

	//marketing section
	Route::group(['prefix'=> 'marketing'], function() {
	Route::get('/','Backend\AdminPagesController@marketing')->name('admin.marketing.index');
	Route::get('/byarea','Backend\AdminPagesController@areaSearch')->name('admin.marketing.area.search');
	Route::get('/byproduct','Backend\AdminPagesController@byProductSearch')->name('user.searchby.product');
	Route::get('/default','Backend\AdminPagesController@userSearch')->name('user.default.search');
	});



});

//Verify token route
Route::get('/token/{id}','Frontend\VerificationController@verify')->name('user.verfication');
Route::get('/resend','Frontend\VerificationController@sendverficationemail')->name('resend.verification.email');




Route::group(['prefix'=> 'user'], function() {

	//profile

	Route::group(['prefix'=> 'profile'], function() {
		Route::get('/','Frontend\UserprofileController@show')->name('user.profile.home');
		Route::get('/myaccounts','Userprofile\MyaccountsController@show')->name('user.profile.myaccounts');
		Route::post('/myaccounts/','Userprofile\MyaccountsController@profileupdate')->name('user.profile.myaccounts');
		Route::get('/orders','Userprofile\MyaccountsController@orders')->name('user.profile.orders');
		Route::get('order/action/id/{id}/status/{action}','Userprofile\MyaccountsController@orderaction')->name('user.orders.action');
		Route::post('orders/search','Userprofile\MyaccountsController@ordersearch')->name('user.orders.search');

	});

	Route::get('/wishlists/','WishlistController@index')->name('wishlists');
	Route::get('/wishlists/delete/{id}','WishlistController@delete')->name('wishlist.delete');

});



Route::group(['prefix'=> 'carts'], function() {

	//carts
	Route::get('/','Frontend\CartsController@index')->name('carts');
	Route::post('/store','Frontend\CartsController@store')->name('carts.store');
	Route::get('/ajax/store','Frontend\CartsController@ajaxstore')->name('carts.ajaxstore');
	Route::get('/updatequantity/{id}/action/{action}/{dd}','Frontend\CartsController@updatequantity')->name('carts.updatequantity');

	Route::get('/updatequantity/delete/{id}','Frontend\CartsController@delete')->name('carts.delete');
	Route::get('/addshipping/{city}','Frontend\CartsController@addShipping')->name('shipping.add');


});

Route::group(['prefix'=> 'wishlists'], function() {

	//wishlists
	Route::get('/add/{id}','WishlistController@store')->name('wishlist.store');


});




Route::group(['prefix'=> 'order'], function() {

	//carts
	Route::post('/store','Frontend\OrdersController@store')->name('orders.store');
	Route::get('/success','Frontend\OrdersController@success')->name('orders.success');



});

// For mobile payment

Route::post('/mobilepayment','MobilePaymentController@store')->name('mobilepayment.store');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// SSLCOMMERZ Start
Route::get('/example1', 'SslCommerzPaymentController@exampleEasyCheckout');
Route::get('/example2', 'SslCommerzPaymentController@exampleHostedCheckout');

Route::post('/pay', 'SslCommerzPaymentController@index')->name('ssl.pay');
Route::post('/pay-via-ajax', 'SslCommerzPaymentController@payViaAjax');

Route::post('/success', 'SslCommerzPaymentController@success');
Route::post('/fail', 'SslCommerzPaymentController@fail');
Route::post('/cancel', 'SslCommerzPaymentController@cancel');

Route::post('/ipn', 'SslCommerzPaymentController@ipn');
//SSLCOMMERZ END



// AAMARPAY  Start
Route::post('/amarpay/getway/payment', 'Frontend\OrdersController@amarpayGetwayPayment')->name('amarpay.getway.payment');
Route::post('payment/success', 'Frontend\OrdersController@paymentSuccess')->name('payment.success');
Route::post('payment/failed', 'Frontend\OrdersController@paymentFailed')->name('payment.failed');


