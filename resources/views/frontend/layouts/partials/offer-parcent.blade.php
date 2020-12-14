@php
	use App\BanglaConverter;
@endphp

@if($product->offer_price > 0)
<h4 class="price">&#2547; 
	@if(Config::get('app.locale') == 'bd')

	  {{BanglaConverter::en2bn($product->offer_price)}}

	<del>&#2547; {{ BanglaConverter::en2bn($product->price) }}</del>

	@elseif(Config::get('app.locale') == 'en')
	
	{{$product->offer_price}} <del> &#2547;{{ $product->price }}</del>
	@endif

</h4>
@else
<h4 class="price">&#2547;

	@if(Config::get('app.locale') == 'bd')

	  {{ BanglaConverter::en2bn($product->price) }}

	@elseif(Config::get('app.locale') == 'en')
	 {{ $product->price }}
	@endif

</h4>
@endif