@extends('backend.layouts.master')

@section('content')

<div class="row">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    
    <div class="card">
        <h5 class="card-header">Add New Brand</h5>
        <div class="card-body">
            @include('backend.layouts.error')
            <form action="{{ route('admin.brand.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                        <label for="name" class="col-form-label">Name</label>
                        <input id="name" type="text" class="form-control" name="name" required="">
                        </div>

                        <div class="col">
                        <label for="name_bd" class="col-form-label">নাম</label>
                        <input id="name_bd" type="text" class="form-control" name="name_bd">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                </div>

                <div class="form-group">
                    <label for="image" class="col-form-label">Images</label>
                    <div class="col-md-4">
                    <input id="image" type="file" class="form-control" name="image">
                    </div>                   
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Add">
                </div>

                
            </form>
        </div>

    </div>
</div>

@endsection