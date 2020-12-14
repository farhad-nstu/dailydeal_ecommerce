@extends('backend.layouts.master')

@section('content')

<div class="row">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    
    <div class="card">
        <h5 class="card-header">Manage Offer</h5>
        <div class="card-body">
            @include('backend.layouts.error')
            
            <table class="table table-hover tablie-striped">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Total Product</th>
                    <th>Action</th>
                    <th>Copy Url</th>
                </tr>

                @foreach($offers as $offer)
                    <tr>
                        <td>#</td>
                        <td>{{$offer->name}}</td>

                        <td>
                          @if(!is_null($offer->start))
                            Start: {{$offer->start}}<br>
                            End: {{$offer->end}}
                            @elseif(!is_null($offer->continue))
                              Continue
                            @else
                              Not selected
                          @endif
                        </td>
                        
                        <td>
                          @if(!is_null($offer->product_id))
                            @php
                              $array = explode(',', $offer->product_id);
                              $total_product = count($array);
                            @endphp
                            {{$total_product}}
                          @else
                            0
                          @endif
                        </td>

                        <td>
                            <a href="{{ route('admin.offer.addmoreproducts', $offer->id) }}" class="btn btn-success">Add Product</a>
                            <a href="{{ route('admin.offer.edit', $offer->id) }}" class="btn btn-success">Edit</a>
                            <a href="#deleteModel{{ $offer->id }}"  data-toggle="modal" class="btn btn-danger">Delete</a>
                        </td>
                        <td><input type="text" name="" value="{{URL::to('/offer/'.$offer->slug)}}"></td>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteModel{{ $offer->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form action="{{ route('admin.offer.delete', $offer->id) }}" method="post">
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