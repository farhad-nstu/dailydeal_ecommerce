@php
	if (Auth::check()) {
		echo "";
	} else {
		header("Location: " . URL::to('/'), true, 302);
        exit();
	}
@endphp

@extends('frontend.layouts.home')

@section('content')
@include('frontend.layouts.partials.usermenu')

    @if(Auth::user()->status == 0)

    
	
                
    @include('frontend.layouts.partials.otpactive')



    @else
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                
                <!--<div class="row justify-content-center">-->
                <!--            <div class="col-md-8">-->
                <!--                <div class="card">-->
                <!--                    <div class="card-header">Dashboard</div>-->

                <!--                    <div class="card-body">-->
                                        

                <!--                        Welcome!-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->

        </main>

@endif

 	
@endsection