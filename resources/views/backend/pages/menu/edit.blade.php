@extends('backend.layouts.master')

@section('content')

<div class="row">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    
    <div class="card">
        <h5 class="card-header">Add New Menu</h5>
        <div class="card-body">
            @include('backend.layouts.error')
            <form action="{{ route('admin.menu.update', $menu->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="name" class="col-form-label">Name</label>
                            <input id="name" type="text" class="form-control" name="name" required="" value="{{$menu->name}}">
                        </div>
                        <div class="col">
                            <label for="name_bd" class="col-form-label">নাম</label>
                            <input id="name_bd" type="text" class="form-control" name="name_bd" value="{{$menu->name_bd}}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="route" class="col-form-label">URL</label>
                    <input id="route" type="text" class="form-control" name="route" value="{{$menu->route}}">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Update">
                </div>

                
            </form>
        </div>

    </div>
</div>

@endsection