@extends('backend.layouts.master')

@section('content')

<div class="row">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    
    <div class="card">
        <h5 class="card-header">Manage Brands</h5>
        <div class="card-body">
            @include('backend.layouts.error')
            
            <table class="table table-hover tablie-striped">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>

                @foreach($brands as $brand)
                    <tr>
                        <td>#</td>
                        <td>{{$brand->name}}</td>

                        <td>
                          @if($brand->image != NULL)
                          <img src="{{ asset('images/brands/'.$brand->image) }}" width="100">
                          @else
                          No image
                          @endif
                        </td>

                        <td>
                            <a href="{{ route('admin.brand.edit', $brand->id) }}" class="btn btn-success">Edit</a>
                            <a href="#deleteModel{{ $brand->id }}"  data-toggle="modal" class="btn btn-danger">Delete</a>
                        </td>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteModel{{ $brand->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form action="{{ route('admin.brand.delete', $brand->id) }}" method="post">
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