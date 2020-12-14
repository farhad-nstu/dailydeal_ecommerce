@php
  if (Auth::check()) {
    echo "";
  } else {
    header("Location: " . URL::to('/'), true, 302);
        exit();
  }
use App\Cart;

@endphp

@extends('frontend.layouts.home')

@section('content')
@include('frontend.layouts.partials.usermenu')

@if(Auth::user()->status == 0)

    
  
                
    @include('frontend.layouts.partials.otpactive')



    @else

        <div class="container">
                
                <div class="row justify-content-center">
                            <div class="col-md-12">
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
                <form action="{{ route('user.orders.search') }}" method="post">
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

            <div class="row">
              <div class="col-12 col-md-2">Product</div>
              <div class="col-12 col-md-2">Price</div>
              <div class="col-12 col-md-2">Payment</div>
              <div class="col-12 col-md-2">Status</div>
              <div class="col-12 col-md-2">Shipping Info</div>
              <div class="col-12 col-md-2">Action</div>
            </div>
            @if(count($orders) > 0)

              @foreach($orders as $order)
              <div class="row shadow-lg p-3 mb-5 bg-white rounded">
              <div class="col-12 col-md-2">
                <a href="#">
                <img src="{{asset('images/order/'.$order->product_image)}}" width="50px;"><br>
                Name: {{$order->product_title}}
                Quantity: {{$order->product_quantity}}
                </a>
              </div>
              <div class="col-12 col-md-2">Price: {{$order->price}}</div>
              <div class="col-12 col-md-2">
                {{$order->status}}
              </div>

              <div class="col-12 col-md-2">
                <p>
                            
                  {{$order->delivery_status}}
                </p>
              </div>
              <div class="col-12 col-md-2">
                Tracking Id: {{$order->tracking_id}}<br>
                <p>
                  <a data-toggle="collapse" data-target="#shipping_info{{$order->id}}" role="button" aria-expanded="false" aria-controls="shipping_info{{$order->id}}">
                    More
                  </a>
                  
                </p>
                
                          
              </div>
              <div class="col-12 col-md-2">
                  
                  @if($order->delivery_status == "Processing")
                        <td>
                          <a href="#deleteModel{{ $order->id }}"  data-toggle="modal" class="btn-outline-danger">Cancle Order</a>
                        </td>
                            <!-- Modal -->
                            <div class="modal fade" id="deleteModel{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    Do you like to cancle permanently?
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                    <a href="{{route('user.orders.action', ['id'=>$order->id,'action'=>"Cancle"])}}" class="btn btn-secondary"  style="
                                      padding: 12px 52px;
                                      border-radius: 50px;
                                      text-align: center;
                                      font-size: 15px;
                                      color: #fff;
                                      text-transform: capitalize;
                                      -webkit-transition: all 0.3s ease;
                                      -moz-transition: all 0.3s ease;
                                      transition: all 0.3s ease;
                                      font-weight: 700;
                                      box-shadow: 0px 5px 15px 0px rgba(102, 162, 27, 0.5);
                                      background: #dc3545;
                                  ">Confirm</a>
                                  </div>
                                </div>
                              </div>
                            </div>

                        @elseif($order->delivery_status == "Out for Delivery")
                            
                        <td>
                          <a href="#deleteModel{{ $order->id }}"  data-toggle="modal" class="btn-success" style="
                              padding: 12px 24px;
                          ">
                        Received</a>
                        </td>
                            <!-- Modal -->
                            <div class="modal fade" id="deleteModel{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    Please confirm you received this order.
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                    <a href="{{route('user.orders.action', ['id'=>$order->id,'action'=>'Delivered'])}}" class="btn btn-secondary"  style="
                                      padding: 12px 52px;
                                      border-radius: 50px;
                                      text-align: center;
                                      font-size: 15px;
                                      color: #fff;
                                      text-transform: capitalize;
                                      -webkit-transition: all 0.3s ease;
                                      -moz-transition: all 0.3s ease;
                                      transition: all 0.3s ease;
                                      font-weight: 700;
                                      box-shadow: 0px 5px 15px 0px rgba(102, 162, 27, 0.5);
                                      background: #17a2b8;
                                      border-color: #17a2b8;
                                  ">Confirm</a>
                                  </div>
                                </div>
                              </div>
                            </div>

                        @elseif($order->delivery_status == "Delivered")
                          <td>Order Delivered</td>
                        @endif

              </div>
              <div class="collapse w-100" id="shipping_info{{$order->id}}">
                  <div class="card card-body">
                    Name: {{$order->name}}
                    Phone: {{$order->phone}}
                    City: {{$order->city_name}}
                    Address: {{$order->shipping_address}}
                          
                  </div>
                </div>

              </div>
              @endforeach
              @endif
            
            {{-- <table class="table table-hover tablie-striped">

                <tr>
                    <th>Customer</th>
                    <th>Products</th>
                    <th>Total Price</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                @foreach($orders as $order)
                  @php
                  $cart_ids = unserialize($order->carts_id);
                  @endphp
                    <tr>
                        
                        <td>{{$order->name}}<br>{{$order->phone}}<br>
                          {{$order->email}}<br>
                          Shipping City{{$order->city}}<br>
                          Shipping Address: {{$order->shipping_address}} <br>
                          Tracking Id: {{$order->tracking_id}}</td>
                        <td>
                        @foreach($cart_ids as $cart_id)
                        @php
                            $cart = Cart::find($cart_id);
                        @endphp

                        
                        @if(!is_null($cart))
                        <p><a href="{{route('product.show',$cart->product->slug)}}">{{$cart->product->title}}</a><br> Price {{$cart->price}} Attributes 
                          @php
                                $attribute_options = $cart->attribute_options;
                                $attribute_options = unserialize($attribute_options);
                            @endphp

                            @foreach($attribute_options as $option)
                                {{$option }}
                            @endforeach
                        </p>
                        @endif
                        
                        @endforeach
                        </td>
                        <td>{{$order->amount}}</td>
                        <td>
                          @if($order->is_paid == 0)
                            Not paid
                          @endif
                        </td>
                        <td>
                          <p>
                            
                            @if($order->status == 0)
                              Processing
                            @elseif($order->status == 1)
                              Out for Delivery
                            @elseif($order->status == 2)
                              Delivered
                            @endif
                          </p>
                          
                        
                      </td>

                        @if($order->status == 0)
                        <td>
                          <a href="#deleteModel{{ $order->id }}"  data-toggle="modal" class="btn btn-danger">Cancle Order</a>
                        </td>
                            <!-- Modal -->
                            <div class="modal fade" id="deleteModel{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    Do you like to cancle permanently?
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                    <a href="{{route('user.orders.action', ['id'=>$order->id,'action'=>3])}}" class="btn btn-secondary"  style="
                                      padding: 12px 52px;
                                      border-radius: 50px;
                                      text-align: center;
                                      font-size: 15px;
                                      color: #fff;
                                      text-transform: capitalize;
                                      -webkit-transition: all 0.3s ease;
                                      -moz-transition: all 0.3s ease;
                                      transition: all 0.3s ease;
                                      font-weight: 700;
                                      box-shadow: 0px 5px 15px 0px rgba(102, 162, 27, 0.5);
                                      background: #dc3545;
                                  ">Confirm</a>
                                  </div>
                                </div>
                              </div>
                            </div>

                        @elseif($order->status == 1)
                            
                        <td>
                          <a href="#deleteModel{{ $order->id }}"  data-toggle="modal" class="btn btn-success" style="
                              padding: 12px 24px;
                          ">
                        Order Received</a>
                        </td>
                            <!-- Modal -->
                            <div class="modal fade" id="deleteModel{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    Please confirm you received this order.
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                    <a href="{{route('user.orders.action', ['id'=>$order->id,'action'=>2])}}" class="btn btn-secondary"  style="
                                      padding: 12px 52px;
                                      border-radius: 50px;
                                      text-align: center;
                                      font-size: 15px;
                                      color: #fff;
                                      text-transform: capitalize;
                                      -webkit-transition: all 0.3s ease;
                                      -moz-transition: all 0.3s ease;
                                      transition: all 0.3s ease;
                                      font-weight: 700;
                                      box-shadow: 0px 5px 15px 0px rgba(102, 162, 27, 0.5);
                                      background: #17a2b8;
                                      border-color: #17a2b8;
                                  ">Confirm</a>
                                  </div>
                                </div>
                              </div>
                            </div>

                        @elseif($order->status == 2)
                          <td>Order Delivered</td>
                        @endif
                        
                        
                    </tr>
                @endforeach

            </table>    --}}

            {{ $orders->links() }}     
                                </div>
                            </div>
                        </div>

        </div>
      </div>

@endif

  
@endsection