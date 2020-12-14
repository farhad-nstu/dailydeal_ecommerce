@extends('frontend.layouts.home')

@section('content')


<main class="main" style="padding-top: 120px;">
            

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h2>Searched Products for <span class="text-info">{{$search}}</span></h2>
                        <div class="row row-sm">
                            @foreach($products as $product)
                            <div class="col-6 col-md-4 col-lg-3">
                                <div class="product-default inner-quickview inner-icon">
                                    <figure>
                                        <a href="{{route('product.show', $product->slug)}}">

                                            @php
                                                $i = 1;
                                            @endphp
                                            @if(count($product->images) > 0)
                                            @foreach($product->images as $image)
                                                @if($i>0)
                                                    <img src="{{ asset('images/'.$image->image) }}">
                                                @endif
                                            @php
                                                $i--;
                                            @endphp
                                            @endforeach
                                            @else
                                            <img src="{{asset('images/no-img.jpg')}}">
                                            
                                            @endif
                                            
                                        </a>
                                        <div class="label-group">
                                            @if($product->offer_price > 0)
                                            <span class="product-label label-cut">

                                            
                                                

                                            @php
                                                $off_amount = $product->price-$product->offer_price;
                                                $off_parcent = intval(($off_amount/$product->price)*100);
                                            @endphp

                                            
                                            @if(Config::get('app.locale') == 'bd')

                                                @php
                                                  echo BanglaConverter::en2bn($off_parcent);
                                                @endphp

                                            @elseif(Config::get('app.locale') == 'en')
                                                {{$off_parcent}}
                                            @endif
                                                
                                                
                                                
                                             %   

                                             OFF</span>@endif
                                        </div>
                                        
                                    </figure>
                                    <div class="product-details">
                                        
                                        <h2 class="product-title">
                                            <a href="{{route('product.show', $product->slug)}}">
                                                @if(Config::get('app.locale') == 'bd')

                                        @if(!is_null($product->title_bd))
                                            {{ $product->title_bd }}
                                        @else
                                            {{ $product->title }}
                                        @endif

                                    @elseif(Config::get('app.locale') == 'en')
                                        {{ $product->title }}
                                    @endif
                                            </a>
                                        </h2>
                                        <div class="ratings-container">
                                            @include('frontend.layouts.partials.starreview')
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            @include('frontend.layouts.partials.offer-parcent')
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                                </div>
                            </div>
                            @endforeach
                            
                        </div>

                        <nav class="toolbox toolbox-pagination">
                            {{ $products->links() }}
                        </nav>
                    </div><!-- End .col-lg-8 -->

                    
                </div><!-- End .row -->
            </div><!-- End .container-fluid -->

            <div class="mb-3"></div><!-- margin -->
        </main><!-- End .main -->


@endsection

@section('extra_script')
<script src="{{asset('assets/js/nouislider.min.js')}}"></script>
@endsection