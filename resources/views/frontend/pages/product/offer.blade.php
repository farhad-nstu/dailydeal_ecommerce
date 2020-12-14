@extends('frontend.layouts.home')

@section('content')



        <!-- shop page start here -->
        <section class="shop-section padding-tb">
            <div class="container">
                <div class="section-header style-2">
                    <h2>Products in <span class="text-info">{{$offer->name}}</span></h2>
                </div>
                
                <div class="section-wrapper col-md-12">

                    

                    <div class="col-md-9">
                    @if(count($products) > 1)
                    @foreach($products as $product)

                    <div class="post_item">
                        <div class="post_item_inner">
                            
                            <div class="post_thumb">
                                <a href="{{route('product.show', $product->slug)}}">
                                    @if(!is_null($product->images))
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach($product->images as $image)
                                        @if($i>0)
                                        <img src=" {{ asset('images/'.$image->image) }}" alt="">
                                        @endif
                                    @php
                                        $i--;
                                    @endphp
                                    @endforeach
                                    @else
                                        <img src="{{asset('images/no-img.jpg') }}" alt="">
                                    @endif
                                    
                                </a>
                                <div class="post_icon">
                                    <a href="#"><i class="far fa-heart"></i></a>
                                    <a href="{{route('product.show', $product->slug)}}"><i class="fas fa-search"></i></a>
                                </div>
                            </div>
                            <div class="post_content">
                                <a href="{{route('product.show', $product->slug)}}" class="title">
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
                                <div class="rating">
                                    @include('frontend.layouts.partials.starreview')
                                </div>
                                @include('frontend.layouts.partials.offer-parcent')
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                        There is no product.
                    @endif


                    

                    </div>

                </div>
                <div class="pagination d-flex justify-content-center">
                    
                </div>
            </div>
        </section>
        <!-- shop page ending here -->


@endsection