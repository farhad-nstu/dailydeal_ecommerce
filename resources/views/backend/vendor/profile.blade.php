@extends('backend.layouts.vendormaster')

@section('content')
        <main role="main" class="col-12"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                
                <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">My Accounts</div>

                                    <div class="card-body">

                                    

                                      <div class="row">
    <!--Middle Part Start-->
    <div class="col-12" id="content">
      <p class="lead">Hello, <strong class="ng-binding">{{Auth::user()->name}}</strong> - To update your account information.</p>
      <form class="ng-pristine ng-valid" action="{{route('vendor.profile.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">

          <div class="col-sm-6">
            <fieldset id="personal-details">
              @if(!is_null(Auth::user()->image))
              <div class="form-group">
               <img src="{{asset('images/vendor/'.Auth::user()->image)}}" width="100px;">
              </div>
              @endif
              <div class="form-group">
                <label for="image">Profile Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">

              </div>
              <legend>Personal Details</legend>

              <div class="form-group required">
                <label for="input-firstname" class="control-label">Full Name</label>
                <input type="text" class="form-control" id="input-firstname" placeholder="First Name" value="{{Auth::user()->name}}" name="name" autocomplete="off">
              </div>
              
              <div class="form-group required">
                <label for="input-email" class="control-label">E-Mail</label>
                <input type="email" class="form-control" id="input-email" placeholder="E-Mail" value="{{Auth::user()->email}}" name="email">
              </div>
              <div class="form-group required">
                <label for="input-telephone" class="control-label">phone</label>
                <input type="tel" class="form-control" id="input-telephone" placeholder="Telephone" value="{{Auth::user()->phone}}" name="phone">
              </div>
              <div class="form-group">
                <label for="input-fax" class="control-label">Address</label>
                <input type="text" class="form-control" id="input-fax" placeholder="Fax" value="{{Auth::user()->address}}" name="address">
              </div>
            </fieldset>
            <br>
          </div>
          <div class="col-sm-6">
            <fieldset>
              <legend>Change Password</legend>
              <div class="form-group required">
                <label for="input-password" class="control-label">Old Password</label>
                <input type="password" class="form-control" id="input-password" placeholder="Old Password" value="" name="old_password" autocomplete="off">
              </div>
              <div class="form-group required">
                <label for="input-password" class="control-label">New Password</label>
                <input type="password" class="form-control" id="input-password" placeholder="New Password" value="" name="password">
              </div>
              <div class="form-group required">
                <label for="input-confirm" class="control-label">New Password Confirm</label>
                <input type="password" class="form-control" id="input-confirm" placeholder="New Password Confirm" value="" name="password_confirmation">
              </div>
            </fieldset>
            
          </div>
        </div>
        



        <div class="buttons clearfix">
          <div class="pull-right">
            <input type="submit" class="btn btn-primary" value="Save Changes" style="
    padding: 10px 15px;
">
          </div>
        </div>
      </form>
    </div>
    <!--Middle Part End-->
  </div>
                                    </div>
                                </div>
                            </div>
                        </div>

        </main>
@endsection