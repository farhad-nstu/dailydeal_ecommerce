@extends('backend.layouts.master')

@section('content')

<div class="row">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    
    <div class="card">
        <h5 class="card-header">Edit Category</h5>
        <div class="card-body">
            @include('backend.layouts.error')
            <form action="{{ route('admin.category.update', $category->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                        <label for="name" class="col-form-label">Name</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{$category->name}}">
                        </div>

                        <div class="col">
                        <label for="name_bd" class="col-form-label">নাম</label>
                        <input id="name_bd" type="text" class="form-control" name="name_bd" value="{{$category->name_bd}}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" rows="3" name="description">{{ $category->name }}</textarea>
                </div>

                <div class="form-group">
                    <label for="parentcategory">Select Parent Category</label>
                    <select class="form-control" id="parentcategory" name="parentcategory">
                        <option value="">Select</option>
                        @foreach($main_categories as $main_category)
                            {{-- <option 
                            @if($single_category->id == $category->parent_id) selected="" @endif 
                            value="{{ $single_category->id }}">{{ $single_category->name }}
                            </option> --}}
                            @if($main_category->id != $category->id)
                            <option value="{{$main_category->id}}" style="font-weight: 700;" @if($main_category->id == $category->parent_id) selected="" @endif >{{ $main_category->name }} </option>
                            @endif
                            
                            
                            @foreach($sub_categories as $sub_category)
                                @if($sub_category->id != $category->id) 
                                    
                                        <option value="{{$sub_category->id}}" @if($sub_category->id == $category->parent_id) selected="" @endif>- {{ $sub_category->name }} </option>
                                    
                                @endif
                            @endforeach
                            
                        @endforeach
                    </select>
                </div>

                @if($category->image != NULL)
                <div class="form-group">
                  <label for="image" class="col-form-label">Old Banner Image</label>
                  <div class="col-md-4">
                  <img src="{{ asset('images/categories/'.$category->image) }}" width="100"><a href="{{route('admin.category_image.delete',$category->id)}}"><i class="fas fa-times-circle" style="
                    margin-left: 7px;
                "></i></a>
                  </div>
                </div>
                @endif

                @if($category->thumbnail != NULL)
                <div class="form-group">
                  <label for="image" class="col-form-label">Old Thumbnail</label>
                  <div class="col-md-4">
                  <img src="{{ asset('images/categories/'.$category->thumbnail) }}" width="100"><a href="{{route('admin.category_thumbnail.delete',$category->id)}}"><i class="fas fa-times-circle" style="
                    margin-left: 7px;
                "></i></a>
                  </div>
                </div>
                @endif

                <div class="form-group">
                    <label for="image" class="col-form-label">New Banner Image (1370 x 420)px</label>
                    <div class="col-md-4">
                    <input id="image" type="file" class="form-control" name="image">
                    </div>                   
                </div>
                <div class="form-group">
                    <label for="thumbnail" class="col-form-label">New Thumbnail Image (300 x 300)px</label>
                    <div class="col-md-4">
                    <input id="thumbnail" type="file" class="form-control" name="thumbnail">
                    </div>                   
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Update">
                </div>

                
            </form>
        </div>

    </div>
</div>

@endsection