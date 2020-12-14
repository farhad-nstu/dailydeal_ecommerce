@php
  use App\Product;
@endphp
@extends('backend.layouts.master')

@section('content')

<div class="row">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    
    <div class="card">
        <h5 class="card-header">Manage Reviews</h5>
        <div class="card-body">
            
            <table class="table table-hover tablie-striped">
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Message</th>
                    <th>Rating</th>
                    <th>Product</th>
                </tr>

                @foreach($reviews as $review)
                    <tr>
                        <td>#</td>
                        <td>{{$review->user_name}}</td>

                        <td>
                         @php
                          $message_original = $review->user_message;
                          $message = substr($message_original, 0,50);
                          
                         @endphp

                         {{$message}} @if(strlen($message_original) >50) ... @endif
                         
                        </td>
                        
                        <td>
                          {{ $review->rating }}
                        </td>

                        <td>
                          @php
                            $product = Product::find($review->product_id);
                          @endphp
                          @if(!is_null($product))
                          <a href="{{route('product.show', $product->slug)}}" target="_blank">View</a>
                          @else
                          Product Deleted
                          @endif
                          
                        </td>
                        
                    </tr>
                @endforeach

            </table>        
               
        </div>

    </div>
</div>

@endsection