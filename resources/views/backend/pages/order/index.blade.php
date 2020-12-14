@php
  use App\Cart;
  use App\Order;
  use App\Shipping;
  use App\Shop;
  use App\City;
  $cities = City::orderBy('priority','asc')->get();

@endphp
@extends('backend.layouts.master')

@section('meta')
<meta name="csrf-token" content="@csrf" />
@endsection

@section('content')

<div class="row">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    
    <div class="card">
        <h5 class="card-header">Manage Orders</h5>
        <div class="card-body">
            @include('backend.layouts.error')


            <div id="custom-search" class="top-search-bar col-md-12">
                <span class="fa fa-search form-control-feedback" style="
    
                position: absolute;
                z-index: 2;
                display: block;
                width: 2.375rem;
                height: 2.375rem;
                line-height: 2.375rem;
                text-align: center;
                pointer-events: none;
                color: #aaa;
                "></span>
                <form action="{{ route('admin.orders.search') }}" method="get">
                  @csrf
                  <div class="row">
                  <div class="col-md-6">
                    <input class="form-control" type="text" placeholder="Phone number or tracking id.." style="padding-left: 2.375rem;" name="search">
                  </div>
                  <div class="col-md-3">
                  <select class="form-control" id="exampleFormControlSelect1" name="status">
                    <option value="">Status</option>
                    <option  value="Processing">Processing</option>
                    <option  value="Out for delivery">Out for delivery</option>
                    <option  value="Delivered">Delivered</option>
                    <option  value="Canceled">Canceled</option>
                  </select>
                  </div>

                  <div class="col-md-3">
                    <button class="btn btn-secondary" type="submit" style="background: gray;">
                      Submit
                    </button>
                  </div>
                  
                
                  </div>

                </form>

                <br>

                <form action="{{ route('admin.order.area.search') }}" method="get">
                  @csrf
                <div class="row">
                  <div class="col-md-9">
                    <label for="search">Search Order By Area: </label>
                    <input list="searches" name="search" id="search" autocomplete="off">
                    
                    <datalist id="searches">
                      @foreach ($cities as $city)
                      <option value="{{$city->name}}">
                      @endforeach  
                      
                    </datalist>
                    <input type="submit" value="Search">
                  </div>
                    
                
                  </div>

                </form>
                
            </div>
            <br>

            <div class="table-responsive">
            <table class="table table-hover tablie-striped">

                <tr>
                    <th>#</th>
                    <th>Customer Name</th>
                    <th>Phone</th>
                    <th>Delivery Address</th>
                    <th>Transaction Id</th>
                    <th>Payment Status</th>
                    <th>Products</th>
                    
                </tr>

                @foreach($orders as $order)
                @php
                  $order_same_trx_id = Order::where('transaction_id', $order->transaction_id)->get();
                  $shipping = Shipping::find(1);
                  if ($order->city_name == "Dhaka") {
                    $shipping_cost = $shipping->inside_dhaka;
                  }else {
                    $shipping_cost = $shipping->outside_dhaka;
                  }
                @endphp
                <tr>
                  <td>
                    #
                  </td>
                  <td>{{$order->name}}</td>
                  <td>{{$order->phone}}</td>
                  <td>City: {{$order->city_name}} Shipping Address: {{$order->shipping_address}}</td>
                  <td>{{$order->transaction_id}}</td>
                  <td>{{$order->status}}</td>
                  
                  @foreach($order_same_trx_id as $single)
                    @php
                    if (!is_null($single->vendor_id)) {
                      $shop = Shop::where('vendor_id', $single->vendor_id)->first();
                    }

                    @endphp
                      

                        {{-- <tr>
                          <td>Image</td>
                          <td>Product Name</td>
                          <td>Price</td>
                          <td>Quantity</td>
                          <td>Message</td>
                          <td>Tracking ID</td>
                          <td>Delivery Status</td>
                        </tr> --}}

                        
                          <td><img src="{{asset('images/order/'.$single->product_image)}}" width="50px;"></td>
                          <td>
                            @if(!is_null($single->product['slug']))
                            <a href="{{route('product.show',$single->product['slug'])}}">{{$single->product_title}}</a>
                            @else
                              <a href="{{route('product.not.available')}}">{{$single->product_title}}</a>
                            @endif
                          </td>
                          <td>Price: {{$single->price}}</td>
                          <td>Quantity: {{$single->product_quantity}}</td>
                          <td>Message: {{$single->message}}</td>
                          <td>Tracking ID: {{$single->tracking_id}}</td>
                          <td>Delivery Status:<br>
                            
                            {{$single->delivery_status}}

                            <div class="dropdown">
                              <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="
                                  padding: 0px 16px;
                              ">
                                Change
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('admin.order.update_status', ['id'=>$single->id,'action'=>'Processing'])}}">Processing</a>
                                <a class="dropdown-item" href="{{route('admin.order.update_status', ['id'=>$single->id,'action'=>'Out for Delivery'])}}">Out for Delivery</a>
                                <a class="dropdown-item" href="{{route('admin.order.update_status', ['id'=>$single->id,'action'=>'Delivered'])}}">Delivered</a>
                                <a class="dropdown-item" href="{{route('admin.order.update_status', ['id'=>$single->id,'action'=>'Cancelled'])}}">Cancelled</a>
                              </div>
                              <br>
                              <br>
                              <form action="{{route('admin.tracking.update', $single->id)}}" method="post">
                              @csrf
                              <textarea placeholder="Courier information." name="courier_info">{{$single->courier_info}}</textarea>
                              <br>
                              <button type="submit" class="btn btn-light">Save</button>
                              </form>
                            </div>
                          </td>
                        

                        
                      
                        
                    
                    @endforeach

                  <td>

                    

                    
                </tr>
      
                @endforeach

            </table>
            </div>   

            {{ $orders->links() }}     
               
        </div>

    </div>
</div>

@endsection