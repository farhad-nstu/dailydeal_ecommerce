@php
use App\Wishlist;
@endphp

@if(Auth::check())

@php
	$wishlist = Wishlist::where('user_id', Auth::user()->id)->where('product_id', $product->id)->get();
@endphp

@if(count($wishlist) > 0)
{{-- <button type="button" class="paction add-wishlist" disabled><span>{{__('home.whishlist_button')}}</span></button> --}}
@else
<a href="{{route('wishlist.store', $product->id)}}" class="paction add-wishlist"><span>{{__('home.whishlist_button')}}</span></a>
@endif

@else

<a href="{{route('login')}}" class="paction add-wishlist"><span>{{__('home.whishlist_button')}}</span></a>

@endif

<style type="text/css">
	.btn {
		font-size: .8rem;
	}
</style>