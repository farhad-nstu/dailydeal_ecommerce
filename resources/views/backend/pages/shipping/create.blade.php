@extends('backend.layouts.master')

@section('content')

<div class="row">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    
    <div class="card">
        <h5 class="card-header">Add/Update General Information</h5>
        <div class="card-body">
            @include('backend.layouts.error')
            <form action="{{ route('admin.shipping.update', $shipping->id) }}" method="post" enctype="multipart/form-data">
                @csrf
            

                <div class="form-group">
                    <label for="inside_dhaka" class="col-form-label">Inside Dhaka Charge</label>
                    <input id="inside_dhaka" type="text" class="form-control" name="inside_dhaka" value="{{ $shipping->inside_dhaka }}">
                </div>

                <div class="form-group">
                    <label for="outside_dhaka" class="col-form-label">Outside Dhaka Charge</label>
                    <input id="outside_dhaka" type="text" class="form-control" name="outside_dhaka" value="{{ $shipping->outside_dhaka }}">
                </div>
                

                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Update">
                </div>

                
            </form>
        </div>

    </div>
</div>

@endsection