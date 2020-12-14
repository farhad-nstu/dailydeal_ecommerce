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
            @include('backend.layouts.error')
            
            <table class="table table-hover tablie-striped">
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Message</th>
                    <th>Rating</th>
                    <th>Product</th>
                    <th>Action</th>
                </tr>

                @foreach($reviews as $review)
                    <tr>
                        <td>#</td>
                        <td>{{$review->user_name}}<br> {{ $review->user_email }}</td>

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

                        <td>
                            <a href="{{ route('admin.review.edit', $review->id) }}" class="btn btn-success">Edit</a>
                            @if($review->status == 1)
                            <a href="{{ route('admin.review.approve', $review->id) }}" class="btn btn-light"><span class="fa fa-thumbs-down" aria-hidden="true"></span> Unapprove</a>
                            @else 
                            <a href="{{ route('admin.review.approve', $review->id) }}" class="btn btn-light"><span class="fa fa-thumbs-up" aria-hidden="true"></span> Approve</a>
                            @endif
                            <a href="#deleteModel{{ $review->id }}"  data-toggle="modal" class="btn btn-danger">Delete</a>
                        </td>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteModel{{ $review->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form action="{{ route('admin.review.delete', $review->id) }}" method="post">
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
               
        </div>

    </div>
</div>

@endsection