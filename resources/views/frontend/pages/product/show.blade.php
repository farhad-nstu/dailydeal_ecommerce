@php
use App\AttributeSet;
use App\Attribute;
use App\Brand;
use App\Review;
use App\Product;
use App\PpageBanner;
use App\Faq;
Use App\BanglaConverter;


@endphp
@extends('frontend.layouts.home')
@extends('frontend.layouts.reviewstyle')

@include('frontend.layouts.reviewstyle')

@section('content')
<div class="container">
    <!-- Single Product Body -->
    <div class="mb-xl-14 mb-6">
        <div class="row">
            <div class="col-md-5 mb-4 mb-md-0">
                <div id="sliderSyncingNav" class="js-slick-carousel u-slick mb-2"
                    data-infinite="true"
                    data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-classic u-slick__arrow-centered--y rounded-circle"
                    data-arrow-left-classes="fas fa-arrow-left u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left ml-lg-2 ml-xl-4"
                    data-arrow-right-classes="fas fa-arrow-right u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right mr-lg-2 mr-xl-4"
                    data-nav-for="#sliderSyncingThumb">
                    @if(!is_null($product->images))
                    @php
                        $i = 1;
                    @endphp

                    @foreach($product->images as $image)
                        <div class="js-slide">
                            <img class="img-fluid" src="{{asset('images/'.$image->image) }}" alt="Image Description"
                            >
                        </div>
                    @endforeach
                    @else
                        <div class="js-slide">
                            <img class="img-fluid" src="{{asset('images/no-img.jpg') }}" alt="Image Description"
                            >
                        </div>
                    @endif
                    
                    
                    
                    
                </div>

                <div id="sliderSyncingThumb" class="js-slick-carousel u-slick u-slick--slider-syncing u-slick--slider-syncing-size u-slick--gutters-1 u-slick--transform-off"
                    data-infinite="true"
                    data-slides-show="5"
                    data-is-thumbs="true"
                    data-nav-for="#sliderSyncingNav">
                    @if(!is_null($product->images))
                    @php
                        $i = 1;
                    @endphp

                    @foreach($product->images as $image)
                        <div class="js-slide">
                            <img class="img-fluid" src="{{asset('images/'.$image->image) }}" alt="Image Description"
                            >
                        </div>
                    @endforeach
                    @else
                        <div class="js-slide">
                            <img class="img-fluid" src="{{asset('images/no-img.jpg') }}" alt="Image Description"
                            >
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-7 mb-md-6 mb-lg-0" id="single_product_id">
                <input type="hidden" class="product_id" value="{{$product->id}}" >
                <div class="mb-2">
                    <div class="border-bottom mb-3 pb-md-1 pb-3">
                        <h2 class="font-size-25 text-lh-1dot2">
                            @if(Config::get('app.locale') == 'bd')

                                @if(!is_null($product->title_bd))
                                    {{ $product->title_bd }}
                                @else
                                    {{ $product->title }}
                                @endif

                            @elseif(Config::get('app.locale') == 'en')
                                {{ $product->title }}
                            @endif
                        </h2>
                        <div class="mb-2">
                            <a href="#reviw">
                                @php
                                    $reviews = Review::where('product_id',$product->id)->get();
                                    $totalrow = 0;
                                    if (count($reviews) >0 ) {
                                        
                                        $totalrating = 0;
                                        foreach ($reviews as $review) {
                                             $totalrating += $review->rating; 
                                         }
                                         $totalrow = count($reviews);
                                         $avarage_rating = $totalrating/$totalrow;

                                         if (is_float($avarage_rating) == TRUE) {
                                             $rating = $avarage_rating + 1;
                                             $final_rating = intval($rating);
                                         }
                                         else {
                                            $final_rating = $avarage_rating;
                                         }

                                         

                                        $rating = $final_rating;
                                     } 
                                     else {
                                        $rating = 0;
                                     }

                                @endphp  

                                

                                <span class="rating">
                                    @foreach(range(1,5) as $i)
                                    <span class="fa-stack" style="width:1em">
                                        <i class="far fa-star fa-stack-1x"></i>

                                        @if($rating >0)
                                            @if($rating >0.5)
                                                <i class="fas fa-star fa-stack-1x"></i>
                                            @else
                                                <i class="fas fa-star-half fa-stack-1x"></i>
                                            @endif
                                        @endif
                                        @php $rating--; @endphp
                                    </span>
                                @endforeach

                                    ({{ $totalrow }} {{__('home.ratings')}})
                                </span>
                                </a>
                        </div>
                        <div class="d-md-flex align-items-center">
                            <div class="ml-md-3 text-gray-9 font-size-14">{{__('home.available')}}: <span class="text-green font-weight-bold">
                                @if($product->quantity == 0)
                                    <span class="text-danger">{{__('home.not_available')}}</span>
                                @else
                                    {{$product->quantity}}
                                @endif    
                            </span></div>
                        </div>
                    </div>
                    <div class="flex-horizontal-center flex-wrap mb-4">
                    <a href="@if(Auth::check()){{route('wishlist.store',$product->id)}}@else {{route('login')}} @endif" class="text-gray-6 font-size-13 mr-2"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                    </div>
                    <p>
                    @if(Config::get('app.locale') == 'bd')

                        @if(!is_null($product->description_bd))
                            {!!html_entity_decode($product->description_bd)!!}
                        @else
                            {!!html_entity_decode($product->description)!!}

                        @endif

                    @elseif(Config::get('app.locale') == 'en')
                    {!!html_entity_decode($product->description)!!}
                    @endif
                    </p>
                    <p><strong>SKU</strong>: {{$product->sku}}</p>
                    
                    <div class="border-top border-bottom py-3 mb-4">
                        <div class="d-flex align-items-center">

                            @php
                                $attributes = $product->attribute_options;
                                if (!is_null($attributes)) {
                                    # code...

                                    $unserialize_attributes = unserialize($attributes);
                                    $all_keys = array_keys($unserialize_attributes);
                                    
                                }
                            @endphp
                            <select class="js-select selectpicker dropdown-select ml-3"
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
                    <div class="d-md-flex align-items-end mb-3">
                        <div class="max-width-150 mb-4 mb-md-0">
                            <h6 class="font-size-14">Quantity</h6>
                            <!-- Quantity -->
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
                            <!-- End Quantity -->
                        </div>
                        <div class="ml-md-3">
                            <a href="#" class="btn px-5 btn-primary-dark transition-3d-hover add_to_cart_button"><i class="ec ec-add-to-cart mr-2 font-size-20"></i> Add to Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Single Product Body -->
    <!-- Single Product Tab -->
    <div class="mb-8">
        <div class="position-relative position-md-static px-md-6">
            <ul class="nav nav-classic nav-tab nav-tab-lg justify-content-xl-center flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble border-0 pb-1 pb-xl-0 mb-n1 mb-xl-0" id="pills-tab-8" role="tablist">
                <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                    <a class="nav-link active" id="Jpills-three-example1-tab" data-toggle="pill" href="#Jpills-three-example1" role="tab" aria-controls="Jpills-three-example1" aria-selected="false">Specification</a>
                </li>
                <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                    <a class="nav-link" id="Jpills-four-example1-tab" data-toggle="pill" href="#Jpills-four-example1" role="tab" aria-controls="Jpills-four-example1" aria-selected="false">Reviews</a>
                </li>
            </ul>
        </div>
        <!-- Tab Content -->
        <div class="borders-radius-17 border p-4 mt-4 mt-md-0 px-lg-10 py-lg-9">
            <div class="tab-content" id="Jpills-tabContent">
                <div class="tab-pane fade active show" id="Jpills-three-example1" role="tabpanel" aria-labelledby="Jpills-three-example1-tab">
                    {{$product->specifications}}
                </div>
                <div class="tab-pane fade" id="Jpills-four-example1" role="tabpanel" aria-labelledby="Jpills-four-example1-tab">
                    <div class="review-form">
                        <div class="review-title">
                            <h5>{{__('home.add_a_review')}}</h5>
                        </div>
                        <form action="{{ route('review.user.create') }}" class="row" method="post">
                            <div class="col-md-4 col-12">
                                <input type="text" name="user_name" placeholder="{{__('home.full_name')}}" class="form-control">
                            </div>
                            <div class="col-md-4 col-12">
                                <input type="text" name="user_email" placeholder="{{__('home.email_address')}}" class="form-control">
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="rating">
                                    <span class="rating-title">{{__('home.your_rating')}} : 
                                        <div class="wrapper">
                                          <fieldset class="rating">
                                            <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>

                                            <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                           
                                            <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                           
                                            <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                            
                                            <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                            
                                        </fieldset>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-12 col-12 pb-2">
                                <textarea rows="5" placeholder="{{__('home.type_here_review')}}" name="user_message" class="form-control"></textarea>
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                @csrf
                            </div>
                            <div class="col-12">
                                <button class="btn px-5 btn-primary-dark transition-3d-hover" type="submit">{{__('home.submit_button')}}</button>
                            </div>
                        </form>

                        @foreach($reviews as $review)

                        <!-- Review -->
                        <div class="border-bottom border-color-1 pb-4 mb-4">
                            <div class="rating">
                                <style type="text/css">
                                    .content span:before, .content span:after {
                                            position: absolute;
                                            content: "";
                                            background-color: transparent;
                                            width: 40px;
                                            height: 2px;
                                            top: 40%;
                                        }
                                </style>
                                @php $rating = $review->rating; @endphp  

                                    @foreach(range(1,5) as $i)
                                        <span class="fa-stack" style="width:1em">
                                            <i class="far fa-star fa-stack-1x"></i>

                                            @if($rating >0)
                                                @if($rating >0.5)
                                                    <i class="fas fa-star fa-stack-1x"></i>
                                                @else
                                                    <i class="fas fa-star-half fa-stack-1x"></i>
                                                @endif
                                            @endif
                                            @php $rating--; @endphp
                                        </span>
                                    @endforeach
                            </div>

                            <p class="text-gray-90">{{ $review->user_message }}</p>

                            <!-- Reviewer -->
                            <div class="mb-2">
                                <strong>{{ $review->user_name }}</strong>
                                <span class="font-size-13 text-gray-23">- {{ date( "F j, Y" ,strtotime($review->created_at)) }}</span>
                            </div>
                            <!-- End Reviewer -->
                        </div>
                        <!-- End Review -->

                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- End Tab Content -->
    </div>
    <!-- End Single Product Tab -->
    <!-- Related products -->
    <div class="mb-6">
        <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
            <h3 class="section-title mb-0 pb-2 font-size-22">Related products</h3>
        </div>
        <ul class="row list-unstyled products-group no-gutters">
            @php
                $related_products = Product::where('category_id', $product->category_id)->paginate(6);

            @endphp
            @if(!is_null($related_products))
            @foreach($related_products as $related_product)
            <li class="col-6 col-md-3 col-xl-2gdot4-only col-wd-2 product-item">
                <div class="product-item__outer h-100">
                    <div class="product-item__inner px-xl-4 p-3">
                        <div class="product-item__body pb-xl-2">
                        <h5 class="mb-1 product-item__title"><a href="single-product-fullwidth.html" class="text-blue font-weight-bold">{{$product->title}}</a></h5>
                            <div class="mb-2">
                                <a href="single-product-fullwidth.html" class="d-block text-center">
                                    @if(!is_null($related_product->images->first()))
                                    <img src="{{asset('images/'.$related_product->images->first()->image)}}" alt="" class="img-fluid">
                                    @else
                                    <img src="{{asset('images/no-img.jpg')}}" alt="" class="img-fluid">
                                    @endif
                                    
                                </a>
                            </div>
                            @include('frontend.layouts.partials.add-to-cart')
                        </div>
                        
                    </div>
                </div>
            </li>
            @endforeach
            @endif
            
        </ul>
    </div>
    
</div>
@endsection
@section('extra_script')
<style type="text/css">
    /* .add-cart,.product-single-qty .btn {
        z-index: 1;
    }

    .handle-counter { overflow: hidden; }

.handle-counter .counter-minus,  .handle-counter .counter-plus,  .handle-counter input {
  float: left;
  text-align: center;
}

.handle-counter .counter-minus,  .handle-counter .counter-plus { text-align: center; }

.handle-counter input {
  max-width: 40px;
  border-width: 1px;
  border-left: none;
  border-right: none;
  height: 36px;
}

.btn {
  padding: 6px 12px;
  border: 1px solid transparent;
  color: #fff;
}

.btn:disabled, .btn:disabled:hover {
  background-color: darkgrey;
  cursor: not-allowed;
} */

/* .btn-primary { background-color: #009dda; }

.btn-primary:hover, .btn-primary:focus { background-color: #0486b9; } */

</style>
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/common.css')}}">
<script src="{{asset('assets/js/zoomsl.min.js')}}"></script>
<script src="https://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5b927288a03dbde6"></script>
<script src="{{asset('js/handleCounter.js')}}"></script>
<script type="text/javascript">
    $(".product-single-image").imagezoomsl();
    $(function ($) {
            var options = {
                minimum: 1,
                maximize: 10,
                onChange: valChanged,
                onMinimum: function(e) {
                    console.log('reached minimum: '+e)
                },
                onMaximize: function(e) {
                    console.log('reached maximize'+e)
                }
            }
            $('#handleCounter').handleCounter(options)
            $('#handleCounter2').handleCounter(options)
            $('#handleCounter3').handleCounter({maximize: 100})
        })
        function valChanged(d) {
//            console.log(d)
        }
</script>


@endsection