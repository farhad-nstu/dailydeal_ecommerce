@php
use App\Shop;
$shop = Shop::where('vendor_id', Auth::user()->id)->first();
@endphp
@extends('backend.layouts.vendormaster')

@section('content')
        <main role="main" class="col-12"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                
                <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header"><i class="fas fa-store"></i> My Shop</div>

                                    <div class="card-body">

                                    

                                      <div class="row">
    <!--Middle Part Start-->
    <div class="col-12" id="content">
      
      @if(is_null($shop))


      <form class="ng-pristine ng-valid" action="{{route('vendor.shop.create')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">

          <div class="col-sm-6">
            <fieldset id="personal-details">

              <div class="form-group required">
                <label for="input-firstname" class="control-label">Shop Name</label>
                <input type="text" class="form-control" id="input-firstname" name="name" autocomplete="off">
              </div>
              
              <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" class="form-control" id="logo" name="logo" accept="image/*">

              </div>
              <div class="form-group">
                <label for="thumbnail">Thumbnail Image</label>
                <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*">

              </div>
              
              <div class="form-group required">
                <label for="phone" class="control-label">Shop Phone Number</label>
                <input type="text" class="form-control" id="phone" name="phone" autocomplete="off">
              </div>

              <div class="form-group required">
                <label for="email" class="control-label">Shop Email</label>
                <input type="text" class="form-control" id="email" name="email" autocomplete="email">
              </div>

              <div class="form-group required">
                <label for="location" class="control-label">Shop Location</label>
                <input type="text" class="form-control" id="location" name="location" autocomplete="off">
              </div>
              
            </fieldset>
            <br>
          </div>
          
        </div>
        



        <div class="buttons clearfix">
          <div class="pull-right">
            <input type="submit" class="btn btn-primary" value="Create" style="
    padding: 10px 15px;
">
          </div>
        </div>
      </form>

      @else
      Shop ID: {{$shop->shop_id}}<br><br>
      <form class="ng-pristine ng-valid" action="{{route('vendor.shop.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">

          <div class="col-sm-6">
            <fieldset id="personal-details">

              <div class="form-group required">
                <label for="input-firstname" class="control-label">Shop Name</label>
                <input type="text" class="form-control" id="input-firstname" placeholder="Shop Name" name="name" autocomplete="off" value="{{$shop->name}}">
              </div>
              @if(!is_null($shop->logo))
              <div class="form-group">
                <label class="control-label">Current Logo</label><br>
               <img src="{{asset('images/shop/'.$shop->logo)}}" width="100px;">
              </div>
              @endif
              <div class="form-group">
                <label for="logo">Change Logo</label>
                <input type="file" class="form-control" id="logo" name="logo" accept="image/*">

              </div>

              @if(!is_null($shop->thumbnail))
              <div class="form-group">
                <label class="control-label">Current Thumbnail</label><br>
               <img src="{{asset('images/shop/'.$shop->thumbnail)}}" width="100px;">
              </div>
              @endif
              <div class="form-group">
                <label for="thumbnail">Change Thumbnail</label>
                <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*">

              </div>
              
              <div class="form-group required">
                <label for="phone" class="control-label">Phone Number</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{$shop->phone}}">
              </div>

              <div class="form-group required">
                <label for="email" class="control-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{$shop->email}}">
              </div>

              <div class="form-group required">
                <label for="location" class="control-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="{{$shop->location}}">
              </div>
              
            </fieldset>
            <br>
          </div>
          
        </div>
        



        <div class="buttons clearfix">
          <div class="pull-right">
            <input type="submit" class="btn btn-primary" value="Update" style="
    padding: 10px 15px;
">
          </div>
        </div>
      </form>

      @endif
    </div>
    <!--Middle Part End-->
  </div>
                                    </div>
                                </div>
                            </div>
                        </div>

        </main>
@endsection