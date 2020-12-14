@php
use App\Menu;
@endphp
@extends('backend.layouts.master')

@section('content')

<div class="row">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    
      {{-- Home Banner Section Start --}}

  <div class="card">
      <div class="card-body">

        <div class="form-group">
            <h4>Main Menu</h4>
        </div>
            <div id="accordion2">
              <div class="card">
              @php
                $main_menus = Menu::orderBy('name', 'asc')->where('menu_location', 'main_menu')->get();
              @endphp
              @foreach($main_menus as $menu)

                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#banners{{$menu->id}}" aria-expanded="true" aria-controls="banners{{$menu->id}}">
                      > {{$menu->name}}
                    </button>
                  </h5>
                </div>

                <div id="banners{{$menu->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion2">
                  <div class="card-body">
                    <form action="{{route('admin.menu.update', $menu->id)}}" method="post" enctype="multipart/form-data">
                  @csrf
                      <div class="form-group">
                        <div class="row">
                          <div class="col">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$menu->name}}" required="">
                          </div>

                          <div class="col">
                            <label for="name_bd">নাম</label>
                            <input type="text" class="form-control" id="name_bd" name="name_bd" value="{{$menu->name_bd}}" required="">
                          </div>
                        </div>
                        
                      </div>

                      <div class="form-group">
                        <label for="flashurl">URL</label>
                        <input type="text" class="form-control" id="flashurl" name="route" value="{{$menu->route}}" required="">
                      </div>
                      <input type="hidden" name="menu_location" value="main_menu">
                      
                      <button type="submit" class="btn btn-primary">Update</button>
                    </form>

                    <br>

                    <a onclick="return confirm('Are you sure you want to delete this item?');" href="{{ route('admin.menu.delete', $menu->id) }}" class="btn btn-danger">Delete</a>
                    <br>
                    {{-- <a href="{{route('admin.menu.delete', $banner->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a> --}}

                  </div>


                </div>

                @endforeach

              </div>
             
            </div>

            <p>
              <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#newbannercreate" aria-expanded="false" aria-controls="newbannercreate">
                Add New Menu (main menu)
              </button>
            </p>
            <div class="collapse" id="newbannercreate">
              <div class="card card-body">
                <form action="{{route('admin.menu.store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                      <div class="form-group">
                        <div class="row">
                          <div class="col">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required="">
                          </div>

                          <div class="col">
                            <label for="name_bd">নাম</label>
                            <input type="text" class="form-control" id="name_bd" name="name_bd" required="">
                          </div>
                        </div>
                        
                      </div>

                      <div class="form-group">
                        <label for="flashurl">URL</label>
                        <input type="text" class="form-control" id="flashurl" name="route" required="">
                      </div>

                      <input type="hidden" name="menu_location" value="main_menu">
                      <button type="submit" class="btn btn-primary">Add</button>
                    
                    </form>
              </div>
            </div>

        

        <div class="form-group">
            <h4>Footer Get to Know Us Menu</h4>
        </div>
            <div id="accordion2">
              <div class="card">
              @php
                $main_menus = Menu::orderBy('name', 'asc')->where('menu_location', 'know_us')->get();
              @endphp
              @foreach($main_menus as $menu)

                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#banners{{$menu->id}}" aria-expanded="true" aria-controls="banners{{$menu->id}}">
                      > {{$menu->name}}
                    </button>
                  </h5>
                </div>

                <div id="banners{{$menu->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion2">
                  <div class="card-body">
                    <form action="{{route('admin.menu.update', $menu->id)}}" method="post" enctype="multipart/form-data">
                  @csrf
                      <div class="form-group">
                        <div class="row">
                          <div class="col">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$menu->name}}" required="">
                          </div>

                          <div class="col">
                            <label for="name_bd">নাম</label>
                            <input type="text" class="form-control" id="name_bd" name="name_bd" value="{{$menu->name_bd}}" required="">
                          </div>
                        </div>
                        
                      </div>

                      <div class="form-group">
                        <label for="flashurl">URL</label>
                        <input type="text" class="form-control" id="flashurl" name="route" value="{{$menu->route}}" required="">
                      </div>

                      <input type="hidden" name="menu_location" value="know_us">
                      <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                    <br>
                    {{-- <a href="{{route('admin.menu.delete', $banner->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a> --}}

                  </div>


                </div>

                @endforeach

              </div>
             
            </div>

            <p>
              <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#gettoknowuscreate" aria-expanded="false" aria-controls="gettoknowuscreate">
                Add New Menu (Get to Know Us Menu)
              </button>
            </p>
            <div class="collapse" id="gettoknowuscreate">
              <div class="card card-body">
                <form action="{{route('admin.menu.store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                      <div class="form-group">
                        <div class="row">
                          <div class="col">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required="">
                          </div>

                          <div class="col">
                            <label for="name_bd">নাম</label>
                            <input type="text" class="form-control" id="name_bd" name="name_bd" required="">
                          </div>
                        </div>
                        
                      </div>

                      <div class="form-group">
                        <label for="flashurl">URL</label>
                        <input type="text" class="form-control" id="flashurl" name="route" required="">
                      </div>

                      <input type="hidden" name="menu_location" value="know_us">
                      <button type="submit" class="btn btn-primary">Add</button>
                    
                    </form>
              </div>
            </div>
        


                <div class="form-group">
            <h4>Need Help Menu</h4>
        </div>
            <div id="accordion2">
              <div class="card">
              @php
                $need_help_menus = Menu::orderBy('name', 'asc')->where('menu_location', 'need_help')->get();
              @endphp
              @foreach($need_help_menus as $menu)

                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#banners{{$menu->id}}" aria-expanded="true" aria-controls="banners{{$menu->id}}">
                      > {{$menu->name}}
                    </button>
                  </h5>
                </div>

                <div id="banners{{$menu->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion2">
                  <div class="card-body">
                    <form action="{{route('admin.menu.update', $menu->id)}}" method="post" enctype="multipart/form-data">
                  @csrf
                      <div class="form-group">
                        <div class="row">
                          <div class="col">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$menu->name}}" required="">
                          </div>

                          <div class="col">
                            <label for="name_bd">নাম</label>
                            <input type="text" class="form-control" id="name_bd" name="name_bd" value="{{$menu->name_bd}}" required="">
                          </div>
                        </div>
                        
                      </div>

                      <div class="form-group">
                        <label for="flashurl">URL</label>
                        <input type="text" class="form-control" id="flashurl" name="route" value="{{$menu->route}}" required="">
                      </div>
                      <input type="hidden" name="menu_location" value="need_help">

                      
                      <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                    <br>
                    {{-- <a href="{{route('admin.menu.delete', $banner->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a> --}}

                  </div>


                </div>

                @endforeach

              </div>
             
            </div>

            <p>
              <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#needhelpuscreate" aria-expanded="false" aria-controls="needhelpuscreate">
                Add New Menu (Need Help Menu)
              </button>
            </p>
            <div class="collapse" id="needhelpuscreate">
              <div class="card card-body">
                <form action="{{route('admin.menu.store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                      <div class="form-group">
                        <div class="row">
                          <div class="col">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required="">
                          </div>

                          <div class="col">
                            <label for="name_bd">নাম</label>
                            <input type="text" class="form-control" id="name_bd" name="name_bd" required="">
                          </div>
                        </div>
                        
                      </div>

                      <div class="form-group">
                        <label for="flashurl">URL</label>
                        <input type="text" class="form-control" id="flashurl" name="route" required="">
                      </div>

                      <input type="hidden" name="menu_location" value="need_help">
                      <button type="submit" class="btn btn-primary">Add</button>
                    
                    </form>
              </div>
            </div>
        
      </div>


  {{-- Home Banner section End --}}
</div>
</div>
</div>
@endsection