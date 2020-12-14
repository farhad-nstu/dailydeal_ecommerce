@extends('backend.layouts.master')

@section('meta')
<meta name="csrf-token" content="@csrf" />
@endsection

@section('content')

<div class="row">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    
    <div class="card">
        <h5 class="card-header">Manage Product</h5>
        <div class="card-body">
            @include('backend.layouts.error')
            
            <table class="table table-hover tablie-striped">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Feature</th>
                    <th>Week Deals</th>
                    <th>Onsale</th>
                    <th>Top Rated</th>
                    <th>Action</th>
                </tr>

                @foreach($products as $product)
                    <tr>
                        <td>#</td>
                        <td>{{$product->title}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>
                          <div class="form-group row">
                              <div class="col-12 col-sm-8 col-lg-6 pt-1">
                                  <a id="checkbox" href="{{route('admin.product.featured', $product->id)}}">
                                      @if($product->featured == 1)
                                      <i class="fas fa-star"></i>
                                      @else
                                      <i class="far fa-star"></i>
                                      @endif
                                  </a>
                              </div>
                          </div>
                        </td>

                        <td>
                          <div class="form-group row">
                              <div class="col-12 col-sm-8 col-lg-6 pt-1">
                                  <a id="checkbox" href="{{route('admin.product.week_deals', $product->id)}}">
                                      @if($product->week_deals == 1)
                                      <i class="fas fa-star"></i>
                                      @else
                                      <i class="far fa-star"></i>
                                      @endif
                                  </a>
                              </div>
                          </div>
                        </td>

                        <td>
                          <div class="form-group row">
                              <div class="col-12 col-sm-8 col-lg-6 pt-1">
                                  <a id="checkbox" href="{{route('admin.product.onsale', $product->id)}}">
                                      @if($product->onsale == 1)
                                      <i class="fas fa-star"></i>
                                      @else
                                      <i class="far fa-star"></i>
                                      @endif
                                  </a>
                              </div>
                          </div>
                        </td>

                        <td>
                          <div class="form-group row">
                              <div class="col-12 col-sm-8 col-lg-6 pt-1">
                                  <a id="checkbox" href="{{route('admin.product.toprated', $product->id)}}">
                                      @if($product->toprated == 1)
                                      <i class="fas fa-star"></i>
                                      @else
                                      <i class="far fa-star"></i>
                                      @endif
                                  </a>
                              </div>
                          </div>
                        </td>

                        <td>
                            <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-success">Edit</a>
                            <a href="#deleteModel{{ $product->id }}"  data-toggle="modal" class="btn btn-danger">Delete</a>
                        </td>
                            <!-- Modal -->
                            <div class="modal fade" id="deleteModel{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form action="{{ route('admin.product.delete', $product->id) }}" method="post">
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