@php
use App\Category;
use App\Review;
use App\ PopularProductSlider;
use App\ PopularProductSliderImage;
use App\TestimonialLeft;
use App\Testimonial;
use App\Banner;
use App\SectionSwitch;
@endphp
@extends('frontend.layouts.home')

@section('content')
	<div class="container mt-5 mb-5">
	<h2>
		@if(Config::get('app.locale') == 'bd')

        @if(!is_null($page->title_bd))
            {{ $page->title_bd }}
        @else
            {{ $page->title }}
        @endif

        @elseif(Config::get('app.locale') == 'en')
            {{ $page->title }}
        @endif
		
	</h2>

	@if(Config::get('app.locale') == 'bd')

    @if(!is_null($page->content_bd))
        {!!html_entity_decode($page->content_bd)!!}
    @else
        {!!html_entity_decode($page->content)!!}
    @endif

    @elseif(Config::get('app.locale') == 'en')
        {!!html_entity_decode($page->content)!!}
    @endif
		
	</div>

@endsection