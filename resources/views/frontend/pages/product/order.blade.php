
@extends('frontend.layouts.home')
@section('css')
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
@endsection

@extends('frontend.layouts.reviewstyle')

@section('content')
<div class="container" style="padding-top: 120px;">
  <div class="payment-form pt-5 pb-5 payment-form">
    <h4>Order Received</h4>
   <div class="table-responsive">
    <table class="table">
    <thead>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Quantity</th>
        <th scope="col">Price</th>
        <th scope="col">Attribute</th>
        <th scope="col">Tracking Id</th>
      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
      <tr>
        <td>{{$order->product_title}}</td>
        <td>{{$order->product_quantity}}</td>
        <td>{{$order->price}}Tk</td>
        <td>@if(!is_null($order->attribute_options)) @php
            $attribute_options = $order->attribute_options;
            $attribute_options = unserialize($attribute_options);
        @endphp
        @foreach($attribute_options as $option)
            {{$option }}
        @endforeach
        @endif</td>
        <td>{{ $order->tracking_id }}</td>
      </tr>
      @endforeach
      <tr>
        <td>Shipping: {{ $order->shipping_cost }} Total: {{$order->amount}}</td>
      </tr>
    
    </tbody>
  </table>
  </div>
   
   {{--  <button type="button" id="print" class="btn btn-primary" style="border-radius: 0;">Print</button> --}}      
    <a href="{{route('index')}}" class="btn btn-primary" style="border-radius: 0;">Go to home</a>      
            
  </div> 
</div>


          


@endsection

@section('script')
<script type="text/javascript">
  $( "#print" ).click(function() {
  $('.payment-form').printThis();
  });
  
</script>
@endsection