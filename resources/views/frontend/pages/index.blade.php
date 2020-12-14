@php
use App\Category;
use App\Brand;
use App\Review;
use App\PopularProductSlider;
use App\PopularProductSliderImage;
use App\TestimonialLeft;
use App\Testimonial;
use App\Banner;
use App\SectionSwitch;
use App\BanglaConverter;
use App\Product;
use App\General;
@endphp
@extends('frontend.layouts.home')

@section('content')

<main id="content" role="main">
            <!-- Slider & Banner Section -->
            <div class="mb-4">
                <div class="container overflow-hidden">
                    <div class="row">

                        <!-- Slider -->
                        <div class="col-xl pr-xl-2 mb-4 mb-xl-0">
                            <div class="bg-img-hero mr-xl-1 height-410-xl max-width-1060-wd max-width-830-xl overflow-hidden">
                                <div class="js-slick-carousel u-slick"
                                    data-autoplay="true"
                                    data-speed="7000"
                                    data-pagi-classes="text-center position-absolute right-0 bottom-0 left-0 u-slick__pagination u-slick__pagination--long justify-content-start ml-9 mb-3 mb-md-5">
                                    
                                    @foreach($sliders as $slider)
                                    <div class="js-slide bg-img-hero-center">
                                        <div class="row height-410-xl py-7 py-md-0 mx-0">
                                            <div class="d-none d-wd-block offset-1"></div>
                                            <div class="col-xl col-6 col-md-6 mt-md-8">
                                                <h1 class="font-size-64 text-lh-57 font-weight-light"
                                                    data-scs-animation-in="fadeInUp">
                                                    <span class="d-block font-size-55" style="color: {{$slider->title_color}};">
                                                        @if(Config::get('app.locale') == 'bd')

                                                        @if(!is_null($slider->title_bd))
                                                            {{ $slider->title_bd }}
                                                        @else
                                                            {{ $slider->title }}
                                                        @endif

                                                        @elseif(Config::get('app.locale') == 'en')
                                                            {{ $slider->title }}
                                                        @endif
                                                    </span>
                                                </h1>
                                                <h6 class="font-size-15 font-weight-bold mb-3"
                                                    data-scs-animation-in="fadeInUp"
                                                    data-scs-animation-delay="200">
                                                    <span style="color: {{$slider->description_color}};">
                                                        @if(Config::get('app.locale') == 'bd')

                                                        @if(!is_null($slider->description_bd))
                                                            {{ $slider->description_bd }}
                                                        @else
                                                            {{ $slider->description }}
                                                        @endif

                                                        @elseif(Config::get('app.locale') == 'en')
                                                            {{ $slider->description }}
                                                        @endif
                                                    </span>
                                                </h6>
                                                
                                                <a href="{{$slider->button_link}}" class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16"
                                                    data-scs-animation-in="fadeInUp"
                                                    data-scs-animation-delay="400" style="background-color: {{$slider->button_color}};">
                                                    @if(Config::get('app.locale') == 'bd')

                                                    @if(!is_null($slider->button_text_bd))
                                                        {{ $slider->button_text_bd }}
                                                    @else
                                                        {{ $slider->button_text }}
                                                    @endif

                                                    @elseif(Config::get('app.locale') == 'en')
                                                        {{ $slider->button_text }}
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="col-xl-7 col-6 d-flex align-items-center ml-auto ml-md-0"
                                                data-scs-animation-in="zoomIn"
                                                data-scs-animation-delay="500">
                                                <img class="img-fluid" src="{{ asset('images/sliders/'.$slider->slider_image) }}" alt="Image Description">
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    
                                </div>
                            </div>
                        </div>
                        <!-- End Slider -->
                        <!-- Banner -->
                        <div class="col-xl-auto pl-xl-2 ">
                            <div class="overflow-hidden">
                                <ul class="list-unstyled row flex-nowrap flex-xl-wrap overflow-auto overflow-lg-visble mx-n2 mx-xl-0 d-xl-block mb-0">
                                    
                                @php
                                    $popularproductsliders = PopularProductSlider::orderBy('serial', 'asc')->skip(0)->take(3)->get();
                                @endphp
                                @if(!is_null($popularproductsliders))
                                @foreach($popularproductsliders as $popularproductslider)
                                @php
                                    $image = PopularProductSliderImage::where('popular_product_slider_id', $popularproductslider->id)->first();
                                @endphp
                                @if(!is_null($image))
                                    <li class="px-2 px-xl-0 flex-shrink-0 flex-xl-shrink-1 mb-3">
                                        <a href="{{$popularproductslider->url}}" class="min-height-126 max-width-320 py-1 py-xl-2 py-wd-1 banner-bg d-flex align-items-center text-gray-90">
                                            <div class="col col-lg-6 col-xl-5 col-wd-6 mb-3 mb-lg-0 pr-lg-0">
                                                <img class="img-fluid" src="{{asset('images/'.$image->image)}}" alt="Image Description">
                                            </div>
                                            <div class="col col-lg-6 col-xl-7 col-wd-6 pr-xl-4 pr-wd-3">
                                                <div class="mb-2 pb-1 font-size-18 font-weight-light text-ls-n1 text-lh-23">
                                                    {{$popularproductslider->title}}
                                                </div>
                                                <div class="link text-gray-90 font-weight-bold font-size-15" href="{{$popularproductslider->url}}">
                                                    Shop now
                                                    <span class="link__icon ml-1">
                                                        <span class="link__icon-inner"><i class="ec ec-arrow-right-categproes"></i></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    @endif
                                    @endforeach
                                    @endif
                                    
                                </ul>
                            </div>
                        </div>
                        <!-- End Banner -->
                    </div>
                </div>
            </div>
            <!-- End Slider & Banner Section -->

            <!-- add banner 19-05-2020 start here -->
            <div class="container">
                <!-- Banner 2 columns -->
                @php
                    $under_slider_banners = Banner::orWhere('short_code', 'u_b_s_1')->orWhere('short_code', 'u_b_s_2')->get();
                @endphp
                <div class="mb-8">
                    <div class="row">
                        @foreach ($under_slider_banners as $item)
                            <div class="col-md-6 mb-3 mb-md-0">
                            <a href="{{$item->url}}">
                            <img class="img-fluid" src="{{asset('images/'.$item->image)}}">
                                </a>
                            </div>
                        @endforeach
                        
                    </div>
                </div>
                <!-- End Banner 2 columns -->
            </div>
            <!-- add banner 19-05-2020 start here -->
            
            
            
            
            
            


            <!-- Week Deals limited -->
            <div class="bg-gray-7 py-7">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-lg-3 col-wd-2">
                            <div class="max-width-244">
                                <div class="d-flex border-bottom border-color-1 mb-3">
                                    <h3 class="section-title mb-0 pb-2 font-size-22">Week Deals limited, Just now</h3>
                                </div>
                                <div class="mb-3 mb-md-2 text-center text-md-left">
                                    <h1 class="font-size-130 font-weight-light mb-2 text-lh-1">50%</h1>
                                    <h6 class="text-gray-2 mb-2">Hurry Up! Offer ends in:</h6>
                                    <div class="js-countdown d-flex mx-n2 justify-content-center justify-content-md-start"
                                        data-end-date="2020/11/30"
                                        data-hours-format="%H"
                                        data-minutes-format="%M"
                                        data-seconds-format="%S">
                                        <div class="text-lh-1 px-2 text-center">
                                            <div class="bg-white rounded-sm border border-width-2 border-primary py-2 px-2 min-width-46">
                                                <div class="text-gray-2 font-size-20 mb-2">
                                                    <span class="js-cd-hours"></span>
                                                </div>
                                                <div class="text-gray-2 font-size-8 text-center">HOURS</div>
                                            </div>
                                        </div>
                                        <div class="text-lh-1 px-2 text-center">
                                            <div class="bg-white rounded-sm border border-width-2 border-primary py-2 px-2 min-width-46">
                                                <div class="text-gray-2 font-size-20 mb-2">
                                                    <span class="js-cd-minutes"></span>
                                                </div>
                                                <div class="text-gray-2 font-size-8 text-center">MINS</div>
                                            </div>
                                        </div>
                                        <div class="text-lh-1 px-2 text-center">
                                            <div class="bg-white rounded-sm border border-width-2 border-primary py-2 px-2 min-width-46">
                                                <div class="text-gray-2 font-size-20 mb-2">
                                                    <span class="js-cd-seconds"></span>
                                                </div>
                                                <div class="text-gray-2 font-size-8 text-center">SECS</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-9 col-wd-10">
                            <div class="">
                                <div class="js-slick-carousel u-slick position-static overflow-hidden u-slick-overflow-visble pb-5 pt-2 px-1"
                                    data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-3 pt-1"
                                    data-slides-show="5"
                                    data-slides-scroll="1"
                                    data-responsive='[{
                                      "breakpoint": 1400,
                                      "settings": {
                                        "slidesToShow": 4
                                      }
                                    }, {
                                        "breakpoint": 1200,
                                        "settings": {
                                          "slidesToShow": 3
                                        }
                                    }, {
                                      "breakpoint": 992,
                                      "settings": {
                                        "slidesToShow": 2
                                      }
                                    }, {
                                      "breakpoint": 768,
                                      "settings": {
                                        "slidesToShow": 2
                                      }
                                    }, {
                                      "breakpoint": 554,
                                      "settings": {
                                        "slidesToShow": 2
                                      }
                                    }, {
                                        "breakpoint": 440,
                                        "settings": {
                                          "slidesToShow": 1
                                        }
                                      }]'>

                                    @php
                                        $week_deals = Product::where('week_deals', 1)->get();
                                    @endphp

                                    @foreach($week_deals as $product)
                                    <div class="js-slide products-group">
                                        <div class="product-item mx-1 remove-divider" id="single_product_id">
                                        <input type="hidden" class="product_id" value="{{$product->id}}" >
                                        <input type="hidden" name="quantity" class="quantity" value="{{$product->quantity}}" >
                                            <div class="product-item__outer h-100">
                                                <div class="product-item__inner bg-white px-wd-4 p-2 p-md-3">
                                                    <div class="product-item__body pb-xl-2">
                                                        <h5 class="mb-1 product-item__title"><a href="{{route('product.show', $product->slug)}}" class="text-blue font-weight-bold">
                                                            @if(Config::get('app.locale') == 'bd')

                                                            @if(!is_null($product->title_bd))
                                                                {{ $product->title_bd }}
                                                            @else
                                                                {{ $product->title }}
                                                            @endif
                    
                                                            @elseif(Config::get('app.locale') == 'en')
                                                                {{ $product->title }}
                                                            @endif
                                                        
                                                        </a></h5>
                                                        <div class="mb-2">
                                                            <a href="{{route('product.show', $product->slug)}}" class="d-block text-center">
                                                                @php
                                                                    $i = 1;
                                                                @endphp
                                                            @if(!is_null($product->images))
                                                                @foreach($product->images as $image)
                                                                    @if($i>0)
                                                                        <img src="{{ asset('images/'.$image->image) }}" class="img-fluid" style="width: 172px; height:172px">
                                                                    @endif
                                                                @php
                                                                    $i--;
                                                                @endphp
                                                                @endforeach
                                                            @else
                                                            <img src="{{asset('images/no-img.jpg')}}" class="img-fluid" style="width: 172px; height:172px">
                                                            @endif
                                                            </a>
                                                        </div>
                                                        @include('frontend.layouts.partials.add-to-cart')

                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                                                   

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Week Deals limited -->
            
            
            
            
            
            
            <!-- Top Categories this Week -->
            <div class="mb-6 bg-gray-7 py-6">
                <div class="container">
                    <div class=" d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0 mb-5">
                        <h3 class="section-title mb-0 pb-2 font-size-22">Categories</h3>
                    </div>
                    @php
                        $categories = Category::orderBy('name', 'asc')->get();
                    @endphp
                    <div class="row flex-nowrap flex-md-wrap overflow-auto overflow-md-visble">

                        @foreach($categories as $category)
                        <div class="col-md-4 col-lg-3 col-xl-4 col-xl-2gdot4 mb-3 flex-shrink-0 flex-md-shrink-1">
                            <div class="bg-white overflow-hidden shadow-on-hover h-100 d-flex align-items-center">
                                <a href="{{route('category.show',$category->slug)}}" class="d-block pr-2 pr-wd-6">
                                    <div class="media align-items-center">
                                        <div class="pt-2">
                                            <img class="img-fluid transform-rotate-15" src="
                                            @if(!is_null($category->thumbnail))
                                            {{asset('images/categories/'.$category->thumbnail)}}
                                            @else
                                            {{asset('images/categories/no-img.jpg')}}
                                            @endif
                                            " alt="Image Description" style="max-width: 100px;">
                                        </div>
                                        <div class="ml-3 media-body">
                                            <h6 class="mb-0 text-gray-90">
                                                @if(Config::get('app.locale') == 'bd')

                                                    @if(!is_null($category->name_bd))
                                                        {{ $category->name_bd }}
                                                    @else
                                                        {{ $category->name }}
                                                    @endif

                                                @elseif(Config::get('app.locale') == 'en')
                                                    {{ $category->name }}
                                                @endif
                                                 
                                            </h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach

                        
                    </div>
                </div>
            </div>
            <!-- End Top Categories this Week -->
            <div class="container">
               
                @php 
                    $categories = Category::orderBy('name', 'asc')->where('parent_id', Null)->get();
                @endphp

                @foreach($categories as $category)
                @php
                    $subcategories = Category::where('parent_id', $category->id)->get();
                @endphp
                <!-- Home Enternteinment -->
                <div class="mb-6">
                    <!-- Nav nav-pills -->
                    <div class="position-relative text-center z-index-2">
                        <div class=" d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0">
                        <h3 class="section-title mb-0 pb-2 font-size-22">{{$category->name}}</h3>
                        </div>
                    </div>
                    <!-- End Nav Pills -->
                    <div class="row">
                        <div class="col-12 col-xl-auto pr-lg-2">
                            <div class="min-width-200 mt-xl-5">
                                <ul class="list-group list-group-flush flex-nowrap flex-xl-wrap flex-row flex-xl-column overflow-auto overflow-xl-visble mb-3 mb-xl-0 border-top border-color-1 border-lg-top-0">
                                    @foreach ($subcategories as $subcategory)
                                <li class="border-color-1 list-group-item border-lg-down-0 flex-shrink-0 flex-xl-shrink-1"><a class="hover-on-bold py-1 px-3 text-gray-90 d-block" href="{{route('category.show',$subcategory->slug)}}">{{$subcategory->name}}</a></li>
                                    @endforeach
                                    
                                </ul>
                            </div>
                        </div>

                        

                        
                        <div class="col-md pl-md-0">
                            <ul class="row list-unstyled products-group no-gutters mb-0">
                                @php
                                
                                    $categories_products = Product::orWhere('category_id', $category->id)->orWhere(function($q) use($subcategories){
                                        foreach($subcategories as $subcategory){
                                            $q->orWhere('category_id', $subcategory->id);
                                        }
                                    })->orderBy('id','desc')->skip(0)->take(8)->get();

                                    $i = 1;
                                @endphp
                                @foreach($categories_products as $product)
                                <li class="col-6 col-md-4 col-wd-3 product-item justify-content-center 
                                @php
                                if($i == 3 or $i == 6): 
                                    echo 'remove-divider-xl remove-divider-md-lg';
                                    elseif($i == 4):
                                    echo 'remove-divider-wd';
                                    elseif($i == 7): 
                                    echo 'd-md-none d-wd-block';
                                    elseif($i == 8):
                                    echo 'd-md-none d-wd-block remove-divider';
                                endif;
                                @endphp

                                ">
                                    <div class="product-item__outer h-100" id="single_product_id">
                                        <input type="hidden" class="product_id" value="{{$product->id}}" >
                                        <input type="hidden" class="quantity" value="{{$product->quantity}}" >
                                        <div class="product-item__inner bg-white p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <h5 class="mb-1 product-item__title"><a href="{{route('product.show', $product->slug)}}" class="text-blue font-weight-bold">
                                                    @if(Config::get('app.locale') == 'bd')

                                                    @if(!is_null($product->title_bd))
                                                        {{ $product->title_bd }}
                                                    @else
                                                        {{ $product->title }}
                                                    @endif
            
                                                    @elseif(Config::get('app.locale') == 'en')
                                                        {{ $product->title }}
                                                    @endif
                                                    </a></h5>
                                                <div class="mb-2">
                                                    <a href="{{route('product.show', $product->slug)}}" class="d-block text-center">
                                                        @php
                                                                $i = 1;
                                                            @endphp
                                                        @if(!is_null($product->images))
                                                            @foreach($product->images as $image)
                                                                @if($i>0)
                                                                    <img src="{{ asset('images/'.$image->image) }}" class="img-fluid" style="width: 172px; height:172px">
                                                                @endif
                                                            @php
                                                                $i--;
                                                            @endphp
                                                            @endforeach
                                                        @else
                                                        <img src="{{asset('images/no-img.jpg')}}" class="img-fluid" style="width: 172px; height:172px">
                                                        @endif    
                                                    </a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                            <div class="prodcut-price col-12">
                                                                <div class="text-gray-100" style="text-align: center;">

                                                                    @php
                                                                        $attributes = $product->attribute_options;
                                                                        if (!is_null($attributes)) {
                                                                            # code...

                                                                            $unserialize_attributes = unserialize($attributes);
                                                                            $all_keys = array_keys($unserialize_attributes);
                                                                            
                                                                        }
                                                                    @endphp
                                                                    <select class="col-12 js-select selectpicker dropdown-select ml-3"
                                                                    data-style="btn-sm bg-white font-weight-normal py-2 border">
                                                                        @if (!is_null($attributes))
                                                                        @foreach($all_keys as $key)

                                                                        @foreach($unserialize_attributes[$key] as $value)
                                                                                @php
                                                                                    $value_as_array = explode(',', $value);
                                                                                    //print_r($value_as_array);
                                                                                @endphp
                                                                                @foreach($value_as_array as $option)
                                                                                    <option value="{{ $option }}">{{$option}}</option>
                                                                                @endforeach
                                                                                {{--  <option value="{{ $value }}">{{$value}}</option> --}}
                                                                        @endforeach
                                                                        @endforeach
                                                                        @endif


                                                                    </select>
                                                                </div>
                                                                
                                                            </div>
                                                            
                                                        

                                                            
                                                            
                                                        </div>

                                                        <div class="flex-center-between mb-1 quantity-container">
                                                            <!-- Quantity -->
                                                            <div class="border rounded-pill py-2 px-3 border-color-1">
                                                                <div class="js-quantity row align-items-center">
                                                                    <div class="col">
                                                                        <input class="js-result form-control h-auto border-0 rounded p-0 shadow-none" type="text" value="1">
                                                                    </div>
                                                                    <div class="col-auto pr-1">
                                                                        <a class="js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0" href="javascript:;">
                                                                            <small class="fas fa-minus btn-icon__inner"></small>
                                                                        </a>
                                                                        <a class="js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0" href="javascript:;">
                                                                            <small class="fas fa-plus btn-icon__inner"></small>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End Quantity -->
                                                        </div>

                                                        <div class="flex-center-between mb-1 quantity-container">
                                                            
                                                            <div class="">
                                                                <a href="#" class="btn btn-primary-dark transition-3d-hover add_to_cart_button"><i class="ec ec-add-to-cart mr-2 font-size-20"></i>Add to Cart</a>
                                                            </div>
                                                            
                                                        </div>
                                                        
                                            </div>
                                            
                                        </div>
                                    </div>
                                </li>
                                @endforeach

                            </ul>
                        </div>


                    </div>
                </div>
                <!-- End Home Enternteinment -->
                @endforeach
                
            </div>
            
            
            
            
            
            
            
            
            
            
            
            
            
            <!-- Brand Carousel -->
            <div class="container mb-8">
                <div class="py-2 border-top border-bottom">
                    <div class="js-slick-carousel u-slick my-1"
                        data-slides-show="5"
                        data-slides-scroll="1"
                        data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-normal u-slick__arrow-centered--y"
                        data-arrow-left-classes="fa fa-angle-left u-slick__arrow-classic-inner--left z-index-9"
                        data-arrow-right-classes="fa fa-angle-right u-slick__arrow-classic-inner--right"
                        data-responsive='[{
                            "breakpoint": 992,
                            "settings": {
                                "slidesToShow": 2
                            }
                        }, {
                            "breakpoint": 768,
                            "settings": {
                                "slidesToShow": 1
                            }
                        }, {
                            "breakpoint": 554,
                            "settings": {
                                "slidesToShow": 1
                            }
                        }]'>
                        @php
                        $brands = Brand::orderBy('name','desc')->get();

                        @endphp
                        @foreach($brands as $brand)
                        <div class="js-slide">
                            <a href="#" class="link-hover__brand">
                                <img class="img-fluid m-auto max-height-50" src="
                                @if(!is_null($brand->image))
                                {{asset('images/brands/'.$brand->image)}}
                                @else
                                {{asset('images/brands/no-img.jpg')}}
                                @endif
                                " alt="Image Description">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- End Brand Carousel -->
        </main>

        @if(SectionSwitch::find(8)->action == 1)
		
		<!-- testimonial section start here -->
		<section class="testimonial padding-tb">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-3">
						@php
							$testimonialleft = TestimonialLeft::find(1);
						@endphp
						<div class="testi_left">
							<div class="testi_content">
								<h2>
									@if(Config::get('app.locale') == 'bd')

							            @if(!is_null($testimonialleft->title_bd))
							                {{ $testimonialleft->title_bd }}
							            @else
							                {{ $testimonialleft->title }}
							            @endif

							        @elseif(Config::get('app.locale') == 'en')
							            {{ $testimonialleft->title }}
							        @endif
								</h2>
								<p>
									@if(Config::get('app.locale') == 'bd')

							            @if(!is_null($testimonialleft->description_bd))
							                {{ $testimonialleft->description_bd }}
							            @else
							                {{ $testimonialleft->description }}
							            @endif

							        @elseif(Config::get('app.locale') == 'en')
							            {{ $testimonialleft->description }}
							        @endif
								</p>
							</div>
						</div>
					</div>
					<div class="col-md-9">
						<div class="testi_right">
							<div class="testi_slider">
								<div class="swiper-wrapper">

									@php
										$testimonials = Testimonial::orderBy('id', 'desc')->get();
									@endphp

									@foreach($testimonials as $testimonial)
									<div class="swiper-slide">
										<div class="testi_item">
											<div class="testi_thumb">
												<img src="{{asset('images/'.$testimonial->image)}}" alt="testimonial">
											</div>
											<div class="testi_content">

												<p><sup><i class="fas fa-quote-left"></i></sup>
													@if(Config::get('app.locale') == 'bd')

											            @if(!is_null($testimonial->comment_bd))
											                {{ $testimonial->comment_bd }}
											            @else
											                {{ $testimonial->comment }}
											            @endif

											        @elseif(Config::get('app.locale') == 'en')
											            {{ $testimonial->comment }}
											        @endif
												</p>
												<span>
													
													@if(Config::get('app.locale') == 'bd')

											            @if(!is_null($testimonial->name_bd))
											                {{ $testimonial->name_bd }}
											            @else
											                {{ $testimonial->name }}
											            @endif

											        @elseif(Config::get('app.locale') == 'en')
											            {{ $testimonial->name }}
											        @endif
												</span>
											</div>
										</div>
									</div>
									@endforeach

								</div>
							</div>
							<div class="testi_slider_pagination"></div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- testimonial ection ending here -->

@endif

@endsection



