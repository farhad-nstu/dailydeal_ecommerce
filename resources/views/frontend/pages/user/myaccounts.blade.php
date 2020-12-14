@php
	if (Auth::check()) {
		echo "";
	} else {
		header("Location: " . URL::to('/'), true, 302);
        exit();
	}

use App\City;
$cities = City::orderBy('priority', 'asc')->get();
@endphp

@extends('frontend.layouts.home')

@section('content')
@include('frontend.layouts.partials.usermenu')	


        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                
                <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">My Accounts</div>

                                    <div class="card-body">

                                    @include('backend.layouts.error')

                                    <form action="{{ route('user.profile.myaccounts') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                          <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}" name="name">
                                          </div>
                                          

                                          <div class="form-group">
                                            <label for="phone_number">Phone Number</label>
                                            <input type="text" class="form-control" id="phone_number" value="{{ Auth::user()->phone_number }}" name="phone_number">
                                          </div>

                                          <div class="form-group">
                                            <label for="address">Present Address</label>
                                            <input type="text" class="form-control" id="address" value="{{ Auth::user()->address }}" name="address">
                                          </div>

                                          <div class="form-group">
                                            <label for="delivery_address">Delivery Address</label>
                                            <input type="text" class="form-control" id="delivery_address" value="{{ Auth::user()->delivery_address }}" name="delivery_address">
                                          </div>

                                          <div class="form-group">
                                            <label for="delivery_phone">Delivery Phone Number</label>
                                            <input type="text" class="form-control" id="delivery_phone" value="{{ Auth::user()->delivery_phone }}" name="delivery_phone">
                                          </div>

                                          <div class="form-group row">
                                            <label for="gender" class="col-md-4 col-form-label">{{ __("Gender") }}</label>

                                                <div class="col-md-6 pt-2">
                                                <label class="radio-inline"><input type="radio" name="gender" value="1" @if(Auth::user()->gender == 1) checked="" @endif>Male</label>

                                                <label class="radio-inline"><input type="radio" name="gender" value="2" @if(Auth::user()->gender == 2) checked="" @endif>Female</label>

                                                </div>
                                            

                                            </div>

                                        <div class="form-group row">
                                            <label for="city" class="col-md-4 col-form-label">{{ __("Select City") }}</label>
                                            <div class="col-md-6 pt-2">
                                                <select class="custom-select" name="city_id">
                                                <option selected>Select</option>
                                                @foreach($cities as $city)
                                                  <option value="{{ $city->name }}" @if($city->name == Auth::user()->city_id) selected @endif>{{ $city->name }}</option>
                                                @endforeach
                                                </select>
                                            </div>

                                        </div>


                                         

                                          <div class="form-group">

                                            <p>
                                              <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="
                                                    padding: 6px;
                                                    border-radius: 0;
                                                    background: dimgray;
                                                ">
                                                Change Password
                                              </button>
                                            </p>
                                            <div class="collapse" id="collapseExample">
                                              <div class="card card-body">
                                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Current Password" name="old_password">
                                                
                                                <div class="row">
                                                    <div class="col">
                                                      <input type="password" class="form-control" placeholder="New Password" name="password">
                                                    </div>
                                                    <div class="col">
                                                      <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
                                                    </div>
                                                  </div>
                                              </div>
                                            </div>

                                            
                                          </div>
                                          <br><br>
                                          <button type="submit" class="btn btn-primary">Update</button>

                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>

        </main>



 	
@endsection