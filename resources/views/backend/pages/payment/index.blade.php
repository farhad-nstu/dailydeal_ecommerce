@php
  use App\Order;
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
                <form action="{{ route('admin.payments.search') }}" method="get">
                  @csrf
                  <div class="row">
                  <div class="col-md-6">
                    <input class="form-control" type="text" placeholder="Phone number or tracking id.." style="padding-left: 2.375rem;" name="search">
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


            <table class="table table-hover tablie-striped">

                <tr>
                    <th>#</th>
                    <th>Phone Number</th>
                    <th>Transaction Id</th>
                    <th>Order Tracking Number</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                @foreach($mobilepayments as $mobilepayment)
                  @php
                  $cart_ids = unserialize($mobilepayment->carts_id);
                  @endphp
                    <tr>
                        <td>#</td>
                        <td>
                          {{ $mobilepayment->phone_number }}
                        <td>
                       
                          {{ $mobilepayment->trxid }}
                        </td>
                        @php
                          $order = Order::find($mobilepayment->order_id);
                        @endphp

                        @if(!is_null($order))
                        <td>
                          {{$order->tracking_id}}
                        </td>
                        <td>
                          {{$mobilepayment->payment_method}}
                        </td>
                        <td>
                          <p>
                            
                            @if($order->is_paid == 0)
                              In Review
                            @elseif($mobilepayment->status == 1)
                              Approve
                            @endif
                          </p>
                          @if($order->is_paid == 0)
                          <a class="btn btn-success" href="{{route('admin.payment.update_status', ['id'=>$order->id,'action'=>1])}}">Approve</a>

                          @else
                          <a class="btn btn-warning" href="{{route('admin.payment.update_status', ['id'=>$order->id,'action'=>0])}}">In Review</a>
                          @endif
                        
                      </td>
                      @else
                        <td>Order Deleted</td>
                        <td></td>
                        <td></td>
                      @endif

                      <td>
                            <a href="#deleteModel{{ $mobilepayment->id }}"  data-toggle="modal" class="btn btn-danger">Delete</a>
                        </td>
                            <!-- Modal -->
                            <div class="modal fade" id="deleteModel{{ $mobilepayment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form action="{{ route('admin.payment.delete', $mobilepayment->id) }}" method="post">
                                  <div class="modal-body">
                                    {{ csrf_field() }}
                                    Do you like to delete permanently?
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-secondary" value="Confirm">
                                  </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                        
                    </tr>
                @endforeach

            </table>   

            {{ $mobilepayments->links() }}     
               
        </div>

    </div>
</div>

@endsection