@extends('backend.layouts.master')



@section('content')

<div class="row">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    
    <div class="card">
        <h5 class="card-header">Edit Slider</h5>
        <div class="card-body">
            @include('backend.layouts.error')
            <form action="{{ route('admin.slider.update', $slider->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                <div class="col">
                    <label for="title" class="col-form-label">Title*</label>
                    <input id="title" type="text" class="form-control" name="title" value="{{$slider->title}}" required="">
                </div>
                <div class="col">
                    <label for="title_bd" class="col-form-label">টাইটেল</label>
                    <input id="title_bd" type="text" class="form-control" name="title_bd" value="{{$slider->title_bd}}">
                </div>
                <div class="col">
                    <label for="title_color" class="col-form-label">Title Color</label>
                    <input id="title_color" type="text" class="form-control" name="title_color" value="{{$slider->title_color}}">
                </div>
                </div>

                <div class="form-row">
                <div class="col">
                    <label for="description">Description*</label>
                    <textarea class="form-control" id="description" rows="3" name="description" required="">{{$slider->description}}</textarea>
                </div>

                <div class="col">
                    <label for="description_bd">বিবরণ*</label>
                    <textarea class="form-control" id="description_bd" rows="3" name="description_bd">{{$slider->description_bd}}</textarea>
                </div>

                <div class="col">
                    <label for="description_color" class="col-form-label">Desciption Color</label>
                    <input id="description_color" type="text" class="form-control" name="description_color" value="{{$slider->description_color}}">
                </div>
                </div>

                <div class="form-row">
                <div class="col">
                    <label for="button_text" class="col-form-label">Button Text*</label>
                    <input id="button_text" type="text" class="form-control" name="button_text" value="{{$slider->button_text}}" required="">
                </div>
                <div class="col">
                    <label for="button_text_bd" class="col-form-label">বাটন টেক্সট*</label>
                    <input id="button_text_bd" type="text" class="form-control" name="button_text_bd" value="{{$slider->button_text_bd}}">
                </div>
                <div class="col">
                    <label for="button_link" class="col-form-label">Button Link*</label>
                    <input id="button_link" type="text" class="form-control" name="button_link" value="{{$slider->button_link}}" required="">
                </div>
                <div class="col">
                    <label for="button_color" class="col-form-label">Button Color</label>
                    <input id="button_color" type="text" class="form-control" name="button_color" value="{{$slider->button_color}}">
                </div>
                </div>

                {{-- @if($slider->background_image != NULL)
                <div class="form-group">
                  <label for="image" class="col-form-label">Old Background Image</label>
                  <div class="col-md-4">
                  <img src="{{ asset('images/sliders/'.$slider->background_image) }}" width="100"><a href="{{route('admin.background_image.delete',$slider->id)}}"><i class="fas fa-times-circle" style="
                    margin-left: 7px;
                "></i></a>
                  </div>
                </div>
                @endif

                <div class="form-group">
                    <label for="background_image" class="col-form-label"> New Background Image</label>
                    <div class="col-md-4">
                    <input id="background_image" type="file" class="form-control" name="background_image">
                    </div>                   
                </div>
 --}}
                @if($slider->slider_image != NULL)
                <div class="form-group">
                  <label for="image" class="col-form-label">Old Slider Image</label>
                  <div class="col-md-4">
                  <img src="{{ asset('images/sliders/'.$slider->slider_image) }}" width="100"><a href="{{route('admin.slider_image.delete',$slider->id)}}"><i class="fas fa-times-circle" style="
                    margin-left: 7px;
                "></i></a>
                  </div>
                </div>
                @endif

                <div class="form-group">
                    <label for="slider_image" class="col-form-label">Slider Image(1920x1200)px</label>
                    <div class="col-md-4">
                    <input id="slider_image" type="file" class="form-control" name="slider_image">
                    </div>                   
                </div>

                {{-- <div class="form-group mt-5">
                    <label>Slider Image Left</label>
                    <div class="switch-button switch-button-xs">
                        <input type="checkbox" @if( $slider->image_reverse == 1) checked="" @endif name="image_position_switch" id="image_position_switch"><span>
                    <label for="image_position_switch"></label></span>
                    </div>
                </div> --}}

                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Update">
                </div>

                
            </form>
        </div>

    </div>
</div>

@endsection