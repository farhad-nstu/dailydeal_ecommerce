@if($product->quantity == 0)
    <img src="{{asset('assets/images/shop/bag.png')}}" alt="bag"> 
<button type="button" class="btn active" disabled> {{__('home.cart_button')}}</button>
@else
    {{-- <img src="{{asset('assets/images/shop/bag.png')}}" alt="bag">  --}}
	<button type="submit" class="paction add-cart" style="cursor: pointer;"><span>{{__('home.cart_button')}}</span></button>
@endif

<style type="text/css">
	.shop-single .section-wrapper .main_side .shop_single_slider .shop_top .shop_right .shop_content .price_btn .btn {
    padding: 8px 14px;
	}
</style>

