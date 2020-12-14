@extends('backend.layouts.master')

@section('content')

<div class="row">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    
    <div class="card">
        <h5 class="card-header">Select Products for <span class="text-primary">{{ $offer->name }}</span></h5>
        <div class="card-body">
            @include('backend.layouts.error')

                <div class="form-group">
                    <label for="name" class="col-form-label">{{ $offer->name }}</label>
                </div>

                <table class="table table-hover tablie-striped">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Offer Price</th>
                    <th>Add/Remove</th>
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
                                  <a id="checkbox" href="{{route('admin.offer.addproducts', ['offer_id'=>$offer->id,'product_id'=>$product->id])}}">
                                      @php
                                        $array = explode(',',$offer->product_id);
                                      @endphp
                                      @if(in_array($product->id,$array))
                                      <i class="fas fa-star"></i>
                                      @else
                                      <i class="far fa-star"></i>
                                      @endif
                                  </a>
                              </div>
                          </div>
                        </td>
                        
                    </tr>
                @endforeach

                {{ $products->links() }}
            </table>   

        </div>

    </div>
</div>

@endsection