@php
use App\Font;
use App\Css;
$fonts = Font::all();
$fonts_active = Font::where('status', '1')->get();
$cssfonts = Css::find(1);
@endphp

@extends('backend.layouts.master')


@section('content')

<div class="row">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2>Font Management</h2>
    </div>

      <div class="card-body">
            @include('backend.layouts.error')
                  <form action="{{route('admin.general.font.store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <label>Upload font</label> &nbsp; &nbsp;&nbsp;
                  <input type="file" name="font" > &nbsp; &nbsp;&nbsp;
                  <input type="submit" value="Add">
                  </form>
                  <br><br>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Font Name</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($fonts as $font)
                      <tr>
                        <td>{{$font->font_name}}</td>
                        <td>
                          <div class="switch-button switch-button-lg">    
                              <input type="checkbox" @if($font->status == 1) checked="" @endif name="featured_home" id="featured_home_{{$font->id}}" onclick="location.href='{{route('admin.general.font.update',$font->id)}}';"><span>
                          <label for="featured_home_{{$font->id}}"></label></span>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                
                
                
                  <br><br>
                  <form action="{{route('admin.general.font.cssupdate')}}" method="get">
                    <label>For Body</label>
                    <div class="form-group col-md-6">
                      
                      <label for="body">Select Font</label>
                      <select class="form-control" id="body" name="body_font">
                        <option>Select</option>
                        @foreach($fonts_active as $font)
                        <option value="{{$font->font_name}}" @if($cssfonts->body == $font->font_name) selected="" @endif>{{$font->font_name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <input type="submit" name="" value="Save" class="btn">
                  </form>

                   <br><br>
                  <form action="{{route('admin.general.font.cssupdate')}}" method="get">
                    <label>For Heading</label>
                    <div class="form-group col-md-6">
                      
                      <label for="heading">Select Font</label>
                      <select class="form-control" id="heading" name="heading_font">
                        <option>Select</option>
                        @foreach($fonts_active as $font)
                        <option value="{{$font->font_name}}" @if($cssfonts->heading == $font->font_name) selected="" @endif>{{$font->font_name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <input type="submit" name="" value="Save" class="btn">
                  </form>

                   <br><br>
                  <form action="{{route('admin.general.font.cssupdate')}}" method="get">
                    <label>For Menu</label>
                    <div class="form-group col-md-6">
                      
                      <label for="menu">Select Font</label>
                      <select class="form-control" id="menu" name="menu_font">
                        <option>Select</option>
                        @foreach($fonts_active as $font)
                        <option value="{{$font->font_name}}" @if($cssfonts->menu == $font->font_name) selected="" @endif>{{$font->font_name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <input type="submit" name="" value="Save" class="btn">
                  </form>

        </div>
    
  </div>


  </div>
</div>

</div>

@endsection



