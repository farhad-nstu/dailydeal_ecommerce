@extends('backend.layouts.master')

@section('content')

<div class="row">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    
    <div class="card" style="text-align: center;">
        <h5 class="card-header">Add New Product</h5>
        <div class="card-body">
            @include('backend.layouts.error')
                
                 <div class="form-group">
                <!-- Example single danger button -->
                <div class="btn-group">
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Select Attribute Set / পণ্যের ধরণ নির্বাচন  করুন 
                  </button>
                  <div class="dropdown-menu">
                    @foreach($attributesets as $attributeset)

                    <a class="dropdown-item" href="{{ route('admin.product.create.final', $attributeset->id) }}">{{$attributeset->name}}</a>

                    @endforeach
                  </div>
                </div>
                </div>
        </div>

    </div>
</div>

@endsection