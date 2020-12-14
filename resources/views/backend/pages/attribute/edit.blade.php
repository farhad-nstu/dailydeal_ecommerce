@extends('backend.layouts.master')

@section('content')

<div class="row">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    
    <div class="card">
        <h5 class="card-header">Edit Attribute</h5>
        <div class="card-body">
            @include('backend.layouts.error')
            <form action="{{ route('admin.attribute.update', $attribute->id) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name" class="col-form-label">Name</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{ $attribute->name }}">
                </div>

                <div class="form-group">
                    <label for="options">Options (seperate by , )</label>
                    <textarea class="form-control" id="options" rows="3" name="options">@php
                            $options = unserialize($attribute->options);
                            foreach ($options as $option) {
                                echo $option.",";
                            }
                        @endphp </textarea>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Add">
                </div>

                
            </form>
        </div>

    </div>
</div>

@endsection