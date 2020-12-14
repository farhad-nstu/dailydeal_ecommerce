@php
  use App\Order;
@endphp

@extends('backend.layouts.vendormaster')

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
                    <option  value="0">Processing</option>
                    <option  value="1">Out for delivery</option>
                    <option  value="2">Delivered</option>
                    <option  value="3">Canceled</option>
                  </select>
                  </div>

                  <div class="col-md-3">
                    <button class="btn btn-secondary" type="submit" style="background: gray;">
                      Submit
                    </button>
                  </div>
                  
                
                  </div>

                </form>
            </div>
            <br>

            <div class="table-responsive">
            <table class="table table-hover tablie-striped">

                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Details</th>
                </tr>

                @foreach($orders as $order)
                @php
                  $order_same_trx_id = Order::where('transaction_id', $order->transaction_id)->get();
              
                @endphp
                <tr>
                  <td>
                    #
                  </td>
                  <td>
                    {{$order->name}}<br>{{$order->phone}}<br>
                          {{$order->email}}<br>
                          Shipping City{{$order->city}}<br>
                          Shipping Address: {{$order->shipping_address}} <br>
                          Payment Status: {{$order->status}}
                  </td>
                  <td>

                    @foreach($order_same_trx_id as $single)
                    
                    <div class="card">
                      <div class="row">
                      <div class="col-12">
                        <img src="{{asset('images/order/'.$single->product_image)}}" width="50px;">
                        @if(!is_null($single->product['slug']))
                        <a href="{{route('product.show',$single->product['slug'])}}">{{$single->product_title}}</a>
                        @else
                          <a href="{{route('product.not.available')}}">{{$single->product_title}}</a>
                        @endif
                        <br>
                        Price: {{$single->price}}
                        <br>
                        Quantity: {{$single->product_quantity}}
                        <br>
                         @if(!is_null($single->attribute_options))
                          @php
                            $options = unserialize($single->attribute_options);
                          @endphp
                          Attributes:
                          @foreach($options as $option)
                            {{$option}} |
                          @endforeach
                        @endif

                        Message: {{$single->message}}
                        <br>
                        Tracking Id: {{$single->tracking_id}}
                        <br>
                        Delivery Status: {{$single->delivery_status}}

                        <div class="dropdown">
                          <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="
                              padding: 0px 16px;
                          ">
                            Change
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{route('vendor.order.update_status', ['id'=>$single->id,'action'=>'Processing'])}}">Processing</a>
                            <a class="dropdown-item" href="{{route('vendor.order.update_status', ['id'=>$single->id,'action'=>'Out for Delivery'])}}">Out for Delivery</a>
                            
                          </div>
                        </div>
                        <br>
                        <form action="{{route('vendor.tracking.update', $single->id)}}" method="post">
                        @csrf
                        <textarea placeholder="Courier information." name="courier_info">{{$single->courier_info}}</textarea>
                        <br>
                        <button type="submit" class="btn btn-light">Save</button>
                        </form>

                      </div>
                      
                      </div>
                    </div>
                    
                    @endforeach

                    <div class="card">
                      Total Amount: {{$order->price+$order->shipping_cost}}
                      <br>
                      Shipping Cost: {{$order->shipping_cost}}
                      <br>
                      Payment Method: {{$order->payment_method}}
                    </div>
                  </td>
                  
                </tr>

                @endforeach

            </table>
            </div>   

            {{ $orders->links() }}     
               
        </div>

    </div>
</div>

@endsection