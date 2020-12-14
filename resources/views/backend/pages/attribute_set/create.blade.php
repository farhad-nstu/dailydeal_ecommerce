@extends('backend.layouts.master')

@section('content')

<div class="row">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    
    <div class="card">
        <h5 class="card-header">Add New Attribute Set</h5>
        <div class="card-body">
            @include('backend.layouts.error')
            <form action="{{ route('admin.attributeSet.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name" class="col-form-label">Name</label>
                    <input id="name" type="text" class="form-control" name="name">
                </div>

                <div class="form-group">
                <label class="col-form-label">Select Attributes</label>
                <div class="form-check">
                    @foreach($attributes as $attribute)
                      <input class="form-check-input" type="checkbox" id="gridCheck" value="{{$attribute->id}}" name="attribute[]">
                      <label class="form-check-label" for="gridCheck">
                        {{$attribute->name}}
                      </label>
                      <br>
                    @endforeach
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