@php
use App\AttributeSet;
use App\Attribute;
use App\Brand;
use App\Review;
use App\Cart;
use App\Shipping;
use App\City;
use App\Product;
use App\ProductImage;

$cities = City::orderBy('priority', 'asc')->get();
$shippingcharge = Shipping::find(1);

$carts = new Cart;
$carts = $carts->carts();
$carts = Session::get('product');

@endphp
@extends('frontend.layouts.home')

@extends('frontend.layouts.reviewstyle')

@section('content')

<main class="main" style="padding-top: 120px;">

  <div class="container">
    <div class="row">
      <div class="col-lg-8 padding-right-lg">
        <div class="cart-table-container">
          <table class="table table-cart">
            <thead>
              <tr>
                <th class="product-col">Product</th>
                <th class="price-col">Price</th>
                <th class="qty-col">Qty</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody>

              @if(Session::has('product'))






              @php

              if (Session::has('product')) {
              $cart_counts = max(array_keys($carts['id'])); $total_products =0;
            }else {
            $cart_counts = 0;
          }
          @endphp


          @for($i = 0; $i <= $cart_counts; $i++)
          @php
          if (isset($carts['quantity'][$i])) {
          $total_products += $carts['quantity'][$i];
        }
        @endphp
        @endfor


        @php
        $total_pcire = 0;
        $total_product_price = 0;
        @endphp

        @for($i = 0; $i <= $cart_counts; $i++)

        @if(isset($carts['price'][$i]))
        @php
        $total_pcire += $carts['price'][$i];
        $total_product_price += $carts['price'][$i];
        $product = Product::find($carts['id'][$i]);
        $product_image = ProductImage::where('product_id',$carts['id'][$i])->first();
        @endphp
        @if(isset($product))
        <tr class="product-row">
          <td class="product-col">
            <figure class="product-image-container">
              <a href="{{route('product.show', $product->slug)}}" class="product-image">
                @if(!is_null($product))
                @if(!is_null($product_image))
                <img src="images/{{ $product_image->image }}" alt="cart">
                @else
                <img src="{{asset('images/no-img.jpg') }}" alt="cart">
                @endif
                @else
                This Product not available
                @endif
              </a>
            </figure>
            <h2 class="product-title">
              <a href="{{route('product.show', $product->slug)}}">{{ $product->title }}</a>
            </h2>

          </td>

          <td>Tk. <span id="mainprice">{{ $carts['mainprice'][$i] }}</span></td>

          <input type="hidden" value="{{ $carts['originalQty'][$i] }}" id="originalQty">
          <td class="handle-counter">
            <div style="
            max-width: 66px;
            margin: 0 auto;
            ">
            @if($carts['quantity'][$i] < 2)
            <a href="#" class="counter-minus btn btn-primary disabled">-</a>
            @else
            <a href="{{route('carts.updatequantity', ['id'=>$i,'action'=>'minus','dd'=>encrypt($carts['price'][$i])])}}" class="counter-minus btn btn-primary quantity_minus" id="quantity_minus">-</a>
            @endif
            <input type="text" value="{{$carts['quantity'][$i]}}" name="qtybutton" id="qtybutton">
            <a href="{{route('carts.updatequantity', ['id'=>$i,'action'=>'plus','dd'=>encrypt($carts['price'][$i])])}}" class="counter-plus btn btn-primary quantity_plus" >+</a>
          </div>
        </td>
        <td>Tk.<span id="product_total_price">
          @php
          echo $carts['price'][$i];
          @endphp
        </span>
      </td>
    </tr>
    <tr class="product-action-row">
      <td colspan="4" class="clearfix">
        <div class="float-left">
          <a href="#" class="btn-move">
            @if(isset($carts['attribute_options'][$i]))
            @php
            $attribute_options = $carts['attribute_options'][$i];
            $attribute_options = unserialize($attribute_options);
            @endphp
            @foreach($attribute_options as $option)
            {{$option }}
            @endforeach
            @endif
          </a>
        </div><!-- End .float-left -->
        <textarea cols="20" rows="1" placeholder="Message" name="message[]" class="form-control"></textarea>
        <div class="float-right">

          <a href="{{route('carts.delete', $i)}}" title="Remove product" class="btn-remove" onclick="return confirm('Are you sure you want to delete this item?');"><span class="sr-only">Remove</span></a>
        </div><!-- End .float-right -->
      </td>
    </tr>
    @endif
    @endif
    @endfor
    @php
    $total_pcire = $total_pcire + Session::get('shipping');
    @endphp
    @endif
  </tbody>


</table>
</div><!-- End .cart-table-container -->


</div><!-- End .col-lg-8 -->

<div class="col-lg-4">
  <div class="cart-summary">
    <h3>Summary</h3>

    <table class="table table-totals">
      <tbody>
        <tr>
          <td>
            <ul>
              @if(Session::has('product'))

              <li class="side_footer">
                <div class="pro_title"></div>
                <div class="pro_shop">
                  @if(Session::has('city'))
                  <p class="text-success before_city">Selected City is {{Session::get('city')}} you can change it from below.</p>
                  <p class="text-success success_city" style="display: none;"></p>

                  <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="
                    border-radius: 0;
                    padding: 5px;
                    ">
                    Change Delivery Area
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach($cities as $city)
                    <a class="dropdown-item shiping_city" href="{{route('shipping.add',$city->name)}}">{{ $city->name }}</a>
                    @endforeach
                  </div>
                </div>

                @else

                <p class="text-danger before_city">Cart not complete Select Delivery Area For Complete Cart</p>
                <p class="text-success success_city" style="display: none;"></p>

                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="
                  border-radius: 0;
                  padding: 5px;
                  ">
                  Select Delivery Area
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  @foreach($cities as $city)
                  <a class="dropdown-item shiping_city" href="{{route('shipping.add',$city->name)}}">{{ $city->name }}</a>
                  @endforeach

                  @endif

                </div>
              </div>

              <span>Inside Dhaka <span id="dhaka_price">{{$shippingcharge->inside_dhaka}}</span></span><br>All Bangladesh <span id="all_bd_price">{{$shippingcharge->outside_dhaka}}</span> </span>

            </div>
          </li>


          @else
          There is no product in cart.
          @endif
        </ul>
      </td>
    </tr>

    <tr>
      <td>Subtotal</td>
      <td>Tk. <span id="subtotal_final"> @if(isset($total_product_price)){{$total_product_price}}@endif </span></td>
    </tr>

    <tr>
      <td>Shipping</td>
      <td id="shipping_charge">
        @if(Session::has('shipping'))
        {{Session::get('shipping')}}
        @endif
      </td>
    </tr>
  </tbody>
  <tfoot>
    <tr>
      <td>Order Total</td>
      <td>Tk.<span id="order_final">@if(isset($total_product_price)){{ $total_pcire }}</span>
        @php
        Session::put('sub_total', $total_pcire);
        @endphp
        @endif
      </td>
    </tr>
  </tfoot>

</table>


<div class="row">
  <div class="form-group mr-3">
    <button class="btn btn-sm btn-success" id="cashonDeliveryBtn">Cash On Delivery</button>
  </div>
  <div class="form-group">
    <button class="btn btn-sm btn-success" id="onlinePaymentBtn">Online Payment</button>
  </div>
</div>


@if(Session::has('product'))
<div class="" style="">
  <form action="{{ route('orders.store') }}" id="cashonDeliveryForm" method="post" style="width: 100%;">
    @csrf
    <table class="table table-totals">
      <tbody>

        <tr>
          <div class="form-group pt-4">
            <label for="full_name">Your Name*</label> 
            @if(Auth::guard('web')->check())
            <input type="text" class="form-control" id="full_name"  name="name" required="" value="{{Auth::guard('web')->user()->name }}">
            @else

            <input type="text" class="form-control" id="full_name"  name="name" required="" placeholder="Enter your full name">
            @endif
          </div>
        </tr>

        <tr>
          <div class="form-group pt-3">
            <label for="full_name">Phone*</label>

            @if(Auth::guard('web')->check())
            <input type="text" class="form-control" name="phone_number" required="" value="{{Auth::guard('web')->user()->phone_number }}">
            @else

            <input type="text" class="form-control" name="phone_number" required="" placeholder="Enter your valid phone number">
            @endif
          </div>
        </tr>

        <tr>
          <div class="form-group pt-3">
            <label for="full_name">Email*</label>

            @if(Auth::guard('web')->check())
            <input type="email" class="form-control" name="email" required="" value="{{Auth::guard('web')->user()->email }}">
            @else 

            <input type="email" class="form-control" name="email" required="" placeholder="Enter your valid email">
            @endif
          </div>
        </tr>

        <tr>
          <div class="form-group pt-3">
            <label for="full_name">Delivery Address*</label>

            @if(Auth::guard('web')->check())
            <textarea rows="2" name="shipping_address" required="" class="form-control" style="min-height: 50px;">{{Auth::guard('web')->user()->delivery_address }}</textarea>
            @else

            <textarea rows="2" name="shipping_address" required="" class="form-control" style="min-height: 50px;" placeholder="Enter your valid address"></textarea>
            @endif
          </div>
        </tr>

      </tbody>
    </table>


    <div class="checkout-methods">
      <button type="submit" class="btn btn-block btn-sm btn-primary">Conferm Order</button>

    </div><!-- End .checkout-methods -->
  </form>



  @php
    date_default_timezone_set('Asia/Dhaka');
    //Generate Unique Transaction ID
    function rand_string( $length ) {
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    $size = strlen( $chars );
    for( $i = 0; $i < $length; $i++ ) {
    $str='';
    $str .= $chars[ rand( 0, $size - 1 ) ];
    }

    return $str;
    }
    $cur_random_value=rand_string(10);


  @endphp

<form action="{{ aamarpay_payment_url() }}" id="submitform" method="post" style="width: 100%;">
  <input type="hidden" name="store_id" value="{{  config('aamarpay.store_id') }}">
  <input type="hidden" name="signature_key" value="{{  config('aamarpay.signature_key') }}">
  <input type="hidden" name="currency" value="BDT">
  <input type="hidden" name="tran_id" value="WEP-{{ $cur_random_value }}">



  <table class="table table-totals">
    <tbody>

      <input type="hidden" class="form-control" id="pay_amount"  name="amount" value="{{ $total_pcire  }}">



      <tr>
        <div class="form-group pt-4">
          <label for="full_name">Your Name*</label>
          @if(Auth::guard('web')->check())
          <input type="text" class="form-control" id="full_name"  name="cus_name" required="" value="{{Auth::guard('web')->user()->name }}">
          @else

          <input type="text" class="form-control" id="full_name"  name="cus_name" required="" placeholder="Enter your full name">
          @endif

        </div>
      </tr>
      <tr>
        <div class="form-group pt-3">
          <label for="full_name">Phone*</label>
          @if(Auth::guard('web')->check())
          <input type="text" class="form-control" name="cus_phone" required="" value="{{Auth::guard('web')->user()->phone_number }}">
          @else
          <input type="text" class="form-control" name="cus_phone" required="" placeholder="Enter your valid phone number">
          @endif

        </div>
      </tr>
      <tr>
        <div class="form-group pt-3">
          <label for="full_name">Email*</label>
          @if(Auth::guard('web')->check())
          <input type="email" class="form-control" name="cus_email" required="" value="{{Auth::guard('web')->user()->email }}">
          @else
          <input type="email" class="form-control" name="cus_email" required="" placeholder="Enter your valid email">
          @endif

        </div>
      </tr>




      <input type="hidden" class="form-control" id="opt_a" name="opt_a" value="">

      <tr>
        <div class="form-group pt-4">
          <label for="full_name">Shipping Address*</label>

          <input type="text" class="form-control" id="full_name"  name="opt_b" required="" placeholder="Enter your valid address">

        </div>
      </tr>


      <div class="form-group">
        <label class="form-label" for="desc">Description:</label>
        <div class="form-control-wrap">
          <input type="text" name="desc" class="form-control" id="desc" placeholder="Your short description">
        </div>
      </div>

    </tbody>
  </table>

  <input type="hidden" name="success_url" value="http://127.0.0.1:8000/payment/success">
  <input type="hidden" name="cancel_url" value="http://dailydeal.com.bd/payment/cancel">
  <input type="hidden" name="fail_url" value = "http://dailydeal.com.bd/payment/failed">


  <div class="checkout-methods">
    <button type="submit" class="btn btn-block btn-sm btn-primary">Pay Now</button>

  </div><!-- End .checkout-methods -->

</form>


</div>
@endif
</div><!-- End .cart-summary -->
</div><!-- End .col-lg-4 -->
</div><!-- End .row -->
</div><!-- End .container -->

<div class="mb-6"></div><!-- margin -->
</main><!-- End .main -->


@endsection

@section('script')
<link rel="stylesheet" href="{{asset('assets/css/cart-style.css')}}">
<script type="text/javascript">


    $(document).ready(function(){
      $('.quantity_plus').click(function(event) {
        event.preventDefault();

        var plus_url = $(this).attr("href");
        var price = parseInt($(this).closest(".product-row").find('#mainprice').text());
        var product_total_price_old = parseInt($(this).closest(".product-row").find('#product_total_price').text());
        var product_total_price = product_total_price_old + price;
        var subtotal_final = parseInt($("#subtotal_final").text()) + price;
        var order_final = parseInt($("#order_final").text()) + price;
        document.getElementById('pay_amount').value = order_final;

        var incQty  = parseInt($(this).closest(".product-row").find('#qtybutton').val());
        var originalQty = parseInt($(this).closest(".product-row").find('#originalQty').val());

        if(incQty < originalQty){
          var quantity_total = parseInt($(this).closest(".product-row").find('#qtybutton').val()) + 1;
        }


        const qtotal = () => $(this).closest(".product-row").find('#qtybutton').val(quantity_total);
        const ptotal = () => $(this).closest(".product-row").find('#product_total_price').text(product_total_price);

        console.log($(this).closest(".product-row").find('#qtybutton').val());


        if(incQty < originalQty){
          $.ajax({
                    url: plus_url,   // request url
                    data:{} ,
                    type: 'GET',
                    success: function (data, status, xhr) {// success callback function
                      console.log('success');
                      qtotal();
                      ptotal();
                      $("#subtotal_final").text(subtotal_final);
                      $("#order_final").text(order_final);
                    },
                    error: function() {
                      var message = "Error cart not updated" ;
                      notif({
                        msg: message,
                        type: "error"
                      });
                    }
                  });
        }

      });


      $('.quantity_minus').click(function(event) {
        event.preventDefault();

        var plus_url = $(this).attr("href");
        var price = parseInt($(this).closest(".product-row").find('#mainprice').text());
        var product_total_price_old = parseInt($(this).closest(".product-row").find('#product_total_price').text());
        var product_total_price = product_total_price_old - price;
        var subtotal_final = parseInt($("#subtotal_final").text()) - price;
        var order_final = parseInt($("#order_final").text()) - price;

        document.getElementById('pay_amount').value = order_final;



        var decQty = parseInt($(this).closest(".product-row").find('#qtybutton').val())
        if(decQty > 1){
          var quantity_total = parseInt($(this).closest(".product-row").find('#qtybutton').val()) - 1;

        } else {
          alert("Minimum limit is 1");
        }

        const qtotal = () => $(this).closest(".product-row").find('#qtybutton').val(quantity_total);
        const ptotal = () => $(this).closest(".product-row").find('#product_total_price').text(product_total_price);





        console.log($(this).closest(".product-row").find('#qtybutton').val());


        if(decQty > 1){
          $.ajax({
                    url: plus_url,   // request url
                    data:{} ,
                    type: 'GET',
                    success: function (data, status, xhr) {// success callback function
                      console.log('success');
                      qtotal();
                      ptotal();
                      $("#subtotal_final").text(subtotal_final);
                      $("#order_final").text(order_final);
                    },
                    error: function() {
                      var message = "Error cart not updated" ;
                      notif({
                        msg: message,
                        type: "error"
                      });
                    }
                  });
        }

      });


      $('.shiping_city').click(function(event) {
        event.preventDefault();

        var city_link = $(this).attr("href");
        var city_name = $(this).text();
        if (city_name == 'Dhaka') {
          var price = $('#dhaka_price').text();
        }else {
          var price = $('#all_bd_price').text();
        }

        var order_final = parseInt($("#subtotal_final").text()) + parseInt(price);

        document.getElementById('pay_amount').value = order_final;

        console.log(city_link, city_name,price);


        $.ajax(
        {
                url: city_link,   // request url
                data:{} ,
                type: 'GET',
                success: function (data, status, xhr) {
                    // success callback function
                    console.log('success');
                    $('.before_city').hide();
                    $('.payment_forms').show();
                    $('.success_city').show().text('Selected shipping city '+city_name+' shipping charge '+price);
                    $('#shipping_charge').text(price);
                    $("#order_final").text(order_final);
                  },
                  error: function() {
                    var message = "Error cart not updated" ;
                    notif({
                      msg: message,
                      type: "error"
                    });
                  }
                });

            // $('#payment_forms').hide();

          });


      $('#submitform').hide();
      $('#cashonDeliveryForm').hide();

      $('#onlinePaymentBtn').on('click', function () {
        $('#submitform').show();
        $('#cashonDeliveryForm').hide();


        $.ajax({
          type: "get",
          url : '{{url("temp/order/store")}}',
          success:function(data) {
            console.log(data);
            document.getElementById('opt_a').value = data;

          }
        });


      });


      $('#cashonDeliveryBtn').on('click', function () {
        $('#submitform').hide();

        $('#cashonDeliveryForm').show();
      });


    });
  </script>
  @endsection
