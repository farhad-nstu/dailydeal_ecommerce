@php
use App\City;
$cities = City::orderBy('priority','asc')->get();
@endphp
@extends('backend.layouts.master')

@section('content')
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    
    <div class="card">
        <h5 class="card-header">Digital Marketing</h5>
        <div class="card-body">
            @include('backend.layouts.error')


            <div id="custom-search">
                
                <form action="{{ route('admin.marketing.area.search') }}" method="get">
                  @csrf
                <div class="row">
                  <div class="col-md-9">
                    <label for="search">Search User By Area: </label>
                    <input list="searches" name="search" id="search" autocomplete="off">
                    
                    <datalist id="searches">
                      @foreach ($cities as $city)
                      <option value="{{$city->name}}">
                      @endforeach  
                      
                    </datalist>
    
                  </div>
                    

                  <div class="col-md-3">
                    <input type="submit" class="form-control" value="Search">
                  </div>
                  
                
                  </div>

                </form>
                <br>

                <form action="{{ route('user.searchby.product') }}" method="get">
                  @csrf
                <div class="row">
                  <div class="col-md-9">
                    <label for="search">Search Order By Area: </label>
                    <input list="searches" name="search" id="search" autocomplete="off">
                    
                    <datalist id="searches">
                      @foreach ($cities as $city)
                      <option value="{{$city->name}}">
                      @endforeach  
                      
                    </datalist>
    
                  </div>
                    

                  <div class="col-md-3">
                    <input type="submit" class="form-control" value="Search">
                  </div>
                  
                
                  </div>

                </form>
                <br>


                <form action="{{route('user.default.search')}}" method="get">
                <div class="row">
                    
                    <div class="col-9">
                    <input type="text" class="form-control" placeholder="Search by phone, email, name" name="search">
                    </div>
                    <div class="col-3">
                        <input type="submit" value="search" class="form-control"> 
                    </div>
                    
                       
                </div>
                </form>
                <br>
                <form action="{{route('user.searchby.product')}}">
                <div class="row">
                    
                    <div class="col-9">
                    <input type="text" class="form-control" placeholder="Search user by product name" name="search">
                    </div>
                    <div class="col-3">
                        <input type="submit" value="search" class="form-control"> 
                    </div>
                    
                       
                </div>
                </form>
                @if(isset($search))
                @if(isset($users))
                <br>
                <label>Send Bulk Sms</label>
                <form action="{{route('sms.bulk')}}" method="post">
                @csrf
                <div class="row">
                    
                    <div class="col-9">
                    @php
                    $phone_number = '';
                    @endphp
                    @foreach($users as $user)
                    @php
                    $phone_number .= $user->phone_number.',';
                    @endphp
                    @endforeach
                    <input type="hidden" name="phone_number" value="{{$phone_number}}">
                    <input type="text" class="form-control" placeholder="Write sms here to send these customers" name="sms">
                    </div>
                    <div class="col-3">
                        <input type="submit" value="send" class="form-control"> 
                    </div>
                    
                       
                </div>
                </form>
                @elseif(isset($orders))
                <br>
                <label>Send Bulk Sms</label>
                <form action="{{route('sms.bulk')}}" method="post">
                @csrf
                <div class="row">
                    
                    <div class="col-9">
                    @php
                    $phone_number = '';
                    @endphp
                    @foreach($orders as $order)
                    @php
                    $phone_number .= $order->phone.',';
                    @endphp
                    @endforeach
                    <input type="hidden" name="phone_number" value="{{$phone_number}}">
                    <input type="text" class="form-control" placeholder="Write sms here to send these customers" name="sms">
                    </div>
                    <div class="col-3">
                        <input type="submit" value="send" class="form-control"> 
                    </div>
                    
                       
                </div>
                </form>
                @endif
                @endif

                <br>
                @if(isset($users))
                <form action="{{route('marketing.pdf.maker')}}" method="post">
                    @php
                    $json_users = json_encode($users);
                    @endphp
                    @csrf
                    <label>Download As</label>
                    <div class="row">
                    <div class="col-9">
                    <input type="hidden" name="users" value="{{$json_users}}">
                    <select name="download_format" class="form-control">
                        <option value="pdf">pdf</option>
                        <option value="xlsx">xlsx</option>
                        <option value="csv">csv</option>
                        <option value="xls">xls</option>
                    </select>
                    </div>
                    <div class="col-3">
                    <input type="submit" value="Download" class="form-control">
                    </div>
                    </div>
                </form>
                @elseif(isset($orders))
                <form action="{{route('marketing.pdf.maker.orders')}}" method="post">
                    @php
                    $json_users = json_encode($orders);
                    @endphp
                    @csrf
                    <label>Download As</label>
                    <div class="row">
                    <div class="col-9">
                    <input type="hidden" name="users" value="{{$json_users}}">
                    <select name="download_format" class="form-control">
                        <option value="pdf">pdf</option>
                        <option value="xlsx">xlsx</option>
                        <option value="csv">csv</option>
                        <option value="xls">xls</option>
                    </select>
                    </div>
                    <div class="col-3">
                    <input type="submit" value="Download" class="form-control">
                    </div>
                    </div>
                </form>
                @endif


            </div>
            <br>

            <div class="table-responsive">
            <table class="table table-hover tablie-striped">

                <tr>
                    <th>#</th>
                    <th>Neme</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
                
                @if (isset($users))
                @foreach ($users as $user)
                    <tr>
                        <td>#</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone_number}}</td>
                        <td>
                            <p>
                              <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample{{$user->id}}" aria-expanded="false" aria-controls="collapseExample{{$user->id}}">
                                SMS
                              </button>
                            </p>
                            <div class="collapse" id="collapseExample{{$user->id}}">
                              <div class="card card-body">
                                <form action="{{route('sms.single')}}" method="post">
                                @csrf
                                <input type="hidden" name="phone_number" value="{{$user->phone_number}}">
                                <textarea class="form-control" name="sms"></textarea><br>
                                <button type="submit" class="btn success">Send</button>
                                </form>
                               
                              </div>
                            </div>
                        </td>
                    </tr>

                @endforeach
                {{ $users->links() }}
                @endif

                @if (isset($orders))
                @foreach ($orders as $order)
                    <tr>
                        <td>#</td>
                        <td>{{$order->name}}</td>
                        <td>{{$order->email}}</td>
                        <td>{{$order->phone}}</td>
                        <td>
                            <p>
                              <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample{{$order->id}}" aria-expanded="false" aria-controls="collapseExample{{$order->id}}">
                                SMS
                              </button>
                            </p>
                            <div class="collapse" id="collapseExample{{$order->id}}">
                              <div class="card card-body">
                                <form action="{{route('sms.single')}}" method="post">
                                @csrf
                                <input type="hidden" name="phone_number" value="{{$order->phone}}">
                                <textarea class="form-control" name="sms"></textarea><br>
                                <button type="submit" class="btn success">Send</button>
                                </form>
                               
                              </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                {{ $orders->links() }}
                @endif
                
                
      
                

            </table>
            </div>   

           
        </div>

    </div>
</div>
@endsection