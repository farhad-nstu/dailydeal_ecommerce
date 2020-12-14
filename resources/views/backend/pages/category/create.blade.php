@extends('backend.layouts.master')

@section('save_button')
    <a href="#" id="save_button">Add</a>
@endsection

@section('content')

<div class="row">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    
    <div class="card">
        <h5 class="card-header">Add New Category</h5>
        <div class="card-body">
            @include('backend.layouts.error')
            <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
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
                    <label for="parentcategory">Select Parent Category</label>
                    <select class="form-control" id="parentcategory" name="parentcategory">
                        <option value="">Select Category</option>
                        @foreach($main_categories as $main_category)
                            <option value="{{$main_category->id}}" style="font-weight: 700;" >{{ $main_category->name }} </option>
                            @foreach($sub_categories as $sub_category)
                                @if($sub_category->parent_id == $main_category->id)
                                    <option value="{{$sub_category->id}}">- {{ $sub_category->name }} </option>
                                @endif
                                
                            @endforeach
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="image" class="col-form-label">Banner Image (1370 x 420)px</label>
                    <div class="col-md-4">
                    <input id="image" type="file" class="form-control" name="image">
                    </div>                   
                </div>
                <div class="form-group">
                    <label for="thumbnail" class="col-form-label">Thumbnail Image (300 x 300)px</label>
                    <div class="col-md-4">
                    <input id="thumbnail" type="file" class="form-control" name="thumbnail">
                    </div>                   
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Add" id="submit">
                </div>

                
            </form>
        </div>

    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">

    //Save button
    $("#save_button").click(function(){
    $("#submit").click(); 
    });
</script>
@endsection