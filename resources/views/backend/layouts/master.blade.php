@php
use App\General;
$general = General::find(1);
@endphp
<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @yield('meta')
    <!-- Bootstrap CSS -->
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css"/>
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ asset('assets/admin/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/libs/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/charts/chartist-bundle/chartist.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/charts/morris-bundle/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/charts/c3charts/c3.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/fonts/flag-icon-css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/preloader/preloader.css') }}">
    @yield('css')
    <title>@php echo $_SERVER['HTTP_HOST']; @endphp admin</title>
</head>

<body>
    
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
            <a class="navbar-brand" target="_blank" href="{{URL::to('/')}}"><img src="{{asset('images/'.$general->logo)}}" alt="" width="150px"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        {{-- <li class="nav-item">
                            <div id="custom-search" class="top-search-bar">
                                <input class="form-control" type="text" placeholder="Search..">
                            </div>
                        </li> --}}
                        {{-- <li class="nav-item dropdown notification">
                            <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-bell"></i> <span class="indicator"></span></a>
                            <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                                <li>
                                    <div class="notification-title"> Notification</div>
                                    <div class="notification-list">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action active">
                                                <div class="notification-info">
                                                    <div class="notification-list-user-img"><img src="assets/admin/images/avatar-2.jpg" alt="" class="user-avatar-md rounded-circle"></div>
                                                    <div class="notification-list-user-block"><span class="notification-list-user-name">Jeremy Rakestraw</span>accepted your invitation to join the team.
                                                        <div class="notification-date">2 min ago</div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="notification-info">
                                                    <div class="notification-list-user-img"><img src="assets/admin/images/avatar-3.jpg" alt="" class="user-avatar-md rounded-circle"></div>
                                                    <div class="notification-list-user-block"><span class="notification-list-user-name">John Abraham </span>is now following you
                                                        <div class="notification-date">2 days ago</div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="notification-info">
                                                    <div class="notification-list-user-img"><img src="assets/admin/images/avatar-4.jpg" alt="" class="user-avatar-md rounded-circle"></div>
                                                    <div class="notification-list-user-block"><span class="notification-list-user-name">Monaan Pechi</span> is watching your main repository
                                                        <div class="notification-date">2 min ago</div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="notification-info">
                                                    <div class="notification-list-user-img"><img src="assets/admin/images/avatar-5.jpg" alt="" class="user-avatar-md rounded-circle"></div>
                                                    <div class="notification-list-user-block"><span class="notification-list-user-name">Jessica Caruso</span>accepted your invitation to join the team.
                                                        <div class="notification-date">2 min ago</div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="list-footer"> <a href="#">View all notifications</a></div>
                                </li>
                            </ul>
                        </li> --}}
                        {{-- <li class="nav-item dropdown connection">
                            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-fw fa-th"></i> </a>
                            <ul class="dropdown-menu dropdown-menu-right connection-dropdown">
                                <li class="connection-list">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="assets/admin/images/github.png" alt="" > <span>Github</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="assets/admin/images/dribbble.png" alt="" > <span>Dribbble</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="assets/admin/images/dropbox.png" alt="" > <span>Dropbox</span></a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="assets/admin/images/bitbucket.png" alt=""> <span>Bitbucket</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="assets/admin/images/mail_chimp.png" alt="" ><span>Mail chimp</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="assets/admin/images/slack.png" alt="" > <span>Slack</span></a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="conntection-footer"><a href="#">More</a></div>
                                </li>
                            </ul>
                        </li> --}}

                        <li class="nav-item">
                            <div class="dropdown-item">@yield('view_button')</div>
                        </li>

                        <li class="nav-item">
                            <div class="dropdown-item">@yield('save_button')</div>
                        </li>


                        <li class="nav-item nav-user">
                            <a class="dropdown-item" href="{{route('admin.logout')}}"><i class="fas fa-power-off mr-2"></i>Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.index') }}"><i class="fa fa-fw fa-rocket"></i>Dashboard</a>
                                
                            </li>
                            

                            <li class="nav-item ">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-orders" aria-controls="submenu-orders"><i class="fas fa-shopping-cart"></i>Orders<span class="badge badge-success">6</span></a>
                                <div id="submenu-orders" class="collapse submenu @if(Request::url() ==  route('admin.orders') or Request::url() ==  route('admin.payments')) show @endif" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.orders') }}"><i class="fas fa-shopping-cart"></i>Orders</a>
                                            
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.payments') }}"><i class="fas fa-dollar-sign"></i>Payments</a>
                                            
                                        </li>
                                        </ul>
                                </div>
                                
                            </li>
                            
                            <li class="nav-item ">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fas fa-tags"></i>Product<span class="badge badge-success">6</span></a>
                                <div id="submenu-1" class="collapse submenu @if(Request::url() ==  route('admin.product.create') or Request::url() ==  route('admin.products') or Request::url() ==  route('admin.reviews') or Request::url() ==  route('admin.city.create') or Request::url() ==  route('admin.cities') or Request::url() ==  route('admin.shipping.edit', 1)) show @endif" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.product.create')}}">Add New</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.products')}}">Products</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.reviews') }}">Reviews</a>
                                        </li>

                                        <li class="nav-item ">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-city" aria-controls="submenu-city"><i class="fa fa-th-large"></i>City<span class="badge badge-success">6</span></a>
                                <div id="submenu-city" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.city.create')}}">Add New</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.cities')}}">Cities</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>

                            

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.shipping.edit', 1) }}"><i class="fas fa-truck"></i>Shipping</a>
                                
                            </li>
                                
                                    </li>
                                        
                                        
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item ">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-th-large"></i>Category<span class="badge badge-success">6</span></a>
                                <div id="submenu-2" class="collapse submenu @if(Request::url() ==  route('admin.category.create') or Request::url() ==  route('admin.categories')) show @endif" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.category.create')}}">Add New</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.categories')}}">Categories</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item ">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-offers" aria-controls="submenu-offers"><i class="fas fa-bullhorn"></i>Offer<span class="badge badge-success">6</span></a>
                                <div id="submenu-offers" class="collapse submenu @if(Request::url() ==  route('admin.offer.create') or Request::url() ==  route('admin.offers')) show @endif" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.offer.create')}}">Add New</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.offers')}}">Offers</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item ">
                            <a class="nav-link" href="{{route('admin.marketing.index')}}"><i class="fa fa-wifi"></i>Marketing</a>    
                            </li>

                            <li class="nav-item ">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-brand" aria-controls="submenu-brand"><i class="fas fa-building"></i>Brand<span class="badge badge-success">6</span></a>
                                <div id="submenu-brand" class="collapse submenu @if(Request::url() ==  route('admin.brand.create') or Request::url() ==  route('admin.brands')) show @endif" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.brand.create')}}">Add New</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.brands')}}">Brands</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item ">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-attribute" aria-controls="submenu-attribute"><i class="fas fa-thumbtack"></i>Page<span class="badge badge-success">6</span></a>
                                <div id="submenu-attribute" class="collapse submenu @if(Request::url() ==  route('admin.page.create') or Request::url() ==  route('admin.pages')) show @endif" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.page.create')}}">Add New</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.pages')}}">Pages</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>

                            


                            <li class="nav-item ">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenucms" aria-controls="submenucms"><i class="fas fa-cogs"></i> CMS <span class="badge badge-success">6</span></a>
                                <div id="submenucms" class="collapse submenu @if(Request::url() ==  route('admin.menu.wpmenu') or Request::url() ==  route('admin.general.edit',1) or Request::url() ==  route('admin.slider.create') or Request::url() ==  route('admin.sliders') or Request::url() ==  route('admin.general.color.edit') or Request::url() ==  route('admin.general.font.edit')) show @endif" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.menu.wpmenu')}}">Menus</a>
                                            
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.sliders')}}" data-toggle="collapse" aria-expanded="false" data-target="#submenucms-3" aria-controls="submenucms-3">Slider</a>
                                            <div id="submenucms-3" class="collapse submenu @if(Request::url() ==  route('admin.slider.create') or Request::url() ==  route('admin.sliders')) show @endif" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{route('admin.slider.create')}}">Add New</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{route('admin.sliders')}}">Sliders</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.general.edit',1)}}" >General</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.general.color.edit')}}" >Color</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.general.font.edit')}}" >Fonts</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>


                            

                            {{-- <li class="nav-item ">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-city" aria-controls="submenu-city"><i class="fa fa-th-large"></i>City<span class="badge badge-success">6</span></a>
                                <div id="submenu-city" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.city.create')}}">Add New</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.cities')}}">Cities</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>

                            

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.shipping.edit', 1) }}"><i class="fas fa-truck"></i>Shipping</a>
                                
                            </li> --}}
                            
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">E-commerce Dashboard Template </h2>
                                <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">E-Commerce Dashboard Template</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <div class="content-preloader">
                    @yield('content')
                    </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="text-md-right footer-links d-none d-sm-block">
                                <a href="javascript: void(0);">About</a>
                                <a href="javascript: void(0);">Support</a>
                                <a href="javascript: void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="{{ asset('assets/admin/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
    <!-- bootstap bundle js -->
    <script src="{{ asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <!-- slimscroll js -->
    <script src="{{ asset('assets/admin/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('assets/admin/libs/js/main-js.js') }}"></script>
    <!-- chart chartist js -->
    <script src="{{ asset('assets/admin/vendor/charts/chartist-bundle/chartist.min.js') }}"></script>
    <!-- sparkline js -->
    <script src="{{ asset('assets/admin/vendor/charts/sparkline/jquery.sparkline.js') }}"></script>
    <!-- morris js -->
    <script src="{{ asset('assets/admin/vendor/charts/morris-bundle/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/charts/morris-bundle/morris.js') }}"></script>
    <!-- chart c3 js -->
    <script src="{{ asset('assets/admin/vendor/charts/c3charts/c3.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/charts/c3charts/d3-5.4.0.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/charts/c3charts/C3chartjs.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/js/dashboard-ecommerce.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/preloader/jquery.preloader.min.js') }}"></script>

    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script type="text/javascript">
        $('.content-preloader').preloader({

          // loading text
          text: '', 

          // from 0 to 100 
          percent: '', 

          // duration in ms
          duration: '700', 

          // z-index property
          zIndex: '', 

          // sets relative position to preloader's parent
          setRelative: false 
          
        });
    </script>

    <style type="text/css">
        .preloader {
        opacity: 1;
        }
        
    </style>

    @yield('script')

</body>
</html>