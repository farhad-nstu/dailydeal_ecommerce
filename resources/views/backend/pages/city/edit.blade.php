@extends('backend.layouts.master')

@section('content')

<div class="row">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    
    <div class="card">
        <h5 class="card-header">Edit City</h5>
        <div class="card-body">
            @include('backend.layouts.error')
            <form action="{{ route('admin.city.update', $city->id) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name" class="col-form-label">Name</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{ $city->name }}">
                </div>

                <div class="form-group">
                    <label for="priority" class="col-form-label">Priority</label>
                    <input id="priority" type="text" class="form-control" name="priority" value="{{ $city->priority }}" >
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Update">
                </div>

                
            </form>
        </div>

    </div>
</div>

@endsection