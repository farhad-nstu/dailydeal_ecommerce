@php
use App\FrontendColor;
$color = FrontendColor::find(1);

@endphp

@extends('backend.layouts.master')
@section('css')
  <link href="{{ asset('assets/admin/vendor/colorpicker/jcolor-picker.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')

<div class="row">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2>General Colors</h2>
    </div>

      <div class="card-body">
            @include('backend.layouts.error')
                  <form action="{{route('admin.general.color.update','primary')}}" method="get">
                  @csrf
                  
                  <label>Update Primary Color</label>
                  <div class="row">
                  <div class="col-3">
                  <input type="color" name="color" value="{{$color->primary}}">
                  </div>
                  <div class="col-6">
                  <input type="submit" class="btn btn-success" name="" value="update">
                  </div>
                  </div>
                  </form>

                  <form action="{{route('admin.general.color.update','secondary')}}" method="get">
                  @csrf
                  <label>Update Secondary Color</label>
                  <div class="row">
                  <div class="col-3">
                  <input type="color" name="color" value="{{$color->secondary}}">
                  </div>
                  <div class="col-6">
                  <input type="submit" class="btn btn-success" name="" value="update">
                  </div>
                  </div>
                  </form>

                  <form action="{{route('admin.general.color.update','tertiary')}}" method="get">
                  @csrf
                  <label>Update Tertiary/3rd Color</label>
                  <div class="row">
                  <div class="col-3">
                  <input type="color" name="color" value="{{$color->tertiary}}">
                  </div>
                  <div class="col-6">
                  <input type="submit" class="btn btn-success" name="" value="update">
                  </div>
                  </div>
                  </form>

                  <form action="{{route('admin.general.color.update','quaternary')}}" method="get">
                  @csrf
                  <label>Update Quaternary/4th Color</label>
                  <div class="row">
                  <div class="col-3">
                  <input type="color" name="color" value="{{$color->quaternary}}">
                  </div>
                  <div class="col-6">
                  <input type="submit" class="btn btn-success" name="" value="update">
                  </div>
                  </div>
                  </form>

                  <form action="{{route('admin.general.color.update','fifth')}}" method="get">
                  @csrf
                  <label>Update 5th Color</label>
                  <div class="row">
                  <div class="col-3">
                  <input type="color" name="color" value="{{$color->fifth}}">
                  </div>
                  <div class="col-6">
                  <input type="submit" class="btn btn-success" name="" value="update">
                  </div>
                  </div>
                  </form>


                  <form action="{{route('admin.general.color.update','body')}}" method="get">
                  @csrf
                  <label>Body Background</label>
                  <div class="row">
                  <div class="col-3">
                  <input type="color" name="color" value="{{$color->body}}">
                  </div>
                  <div class="col-6">
                  <input type="submit" class="btn btn-success" name="" value="update">
                  </div>
                  </div>
                  </form>

        </div>
    
  </div>


  </div>
</div>

</div>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>

<script src="{{ asset('assets/admin/vendor/colorpicker/jcolor-picker.min.js') }}"></script>
<script type="text/javascript">
  $('#my-color-picker').jColorPicker();
  $('#my-color-picker2').jColorPicker();
  $('#my-color-picker3').jColorPicker();
  $('#my-color-picker4').jColorPicker();

</script>
@endsection

<style type="text/css">
  .jcolor-picker{
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  color: #fff;
  font-family: Arial, Helvetica, sans-serif;
  font-size: 13px;
}

.jcolor-picker [data-type="btn"]>[data-type="arrow"] {
    display: none !important;
}

.jcolor-picker [data-type="types"] {
    display: none !important;
}

</style>