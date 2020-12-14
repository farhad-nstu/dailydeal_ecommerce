@php
use App\General;
use App\Category;
use Harimayco\Menu\Models\Menus;
use Harimayco\Menu\Models\MenuItems;
use App\Product;
Use App\Cart;
Use App\BanglaConverter;
use App\SectionSwitch;
use App\Counter;
use App\User;
use App\FrontendColor;
use App\Banner;
use Illuminate\Support\Facades\Session;

$general = General::find(1);
$categories = Category::orderBy('name', 'asc')->get();
$products = Product::orderBy('id', 'desc')->get();

$carts = new Cart;
$carts = $carts->carts();

$carts = Session::get('product');


// $main_menu = Menu::getByName('Main Menu');
// $primary_menu = Menu::byLocation('primary');
// $mobile_menu = Menu::byLocation('mobile');
// $footer_right_menu = Menu::byLocation('footer_right');
// $footer_left_menu = Menu::byLocation('footer_left');

$color = FrontendColor::find(1);

@endphp

@php
$adsfsdfew = General::find(1);
$asdfsse = $adsfsdfew->thisisfunction;
@endphp


@if($asdfsse === 1)


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{$general->meta_name}}</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="{{$general->meta_description}}">
		<meta name="keywords" content="{{$general->meta_name}}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('arabian-assets/images/icons/favicon.ico')}}">

    <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">

        <!-- CSS Implementing Plugins -->
        <link rel="stylesheet" href="{{asset('arabian-assets/vendor/font-awesome/css/fontawesome-all.min.css')}}">
        <link rel="stylesheet" href="{{asset('arabian-assets/css/font-electro.css')}}">

        <link rel="stylesheet" href="{{asset('arabian-assets/vendor/animate.css/animate.min.css')}}">
        <link rel="stylesheet" href="{{asset('arabian-assets/vendor/hs-megamenu/src/hs.megamenu.css')}}">
        <link rel="stylesheet" href="{{asset('arabian-assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css')}}">
        <link rel="stylesheet" href="{{asset('arabian-assets/vendor/fancybox/jquery.fancybox.css')}}">
        <link rel="stylesheet" href="{{asset('arabian-assets/vendor/slick-carousel/slick/slick.css')}}">
        <link rel="stylesheet" href="{{asset('arabian-assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/notifIt.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/swiper.min.css') }}">
        <link rel="stylesheet" href="{{asset('arabian-assets/vendor/ion-rangeslider/css/ion.rangeSlider.css')}}">
        <!-- CSS Electro Template -->
        <link rel="stylesheet" href="{{asset('arabian-assets/css/theme.css')}}">
        <style>
            #ui_notifIt p {
                color: white;
            }

            /*swiper slider start*/
            .testimonial .testi_right .testi_slider {
                overflow: hidden;
                border-radius: 12px;
                border: 1px solid #eee;
            }
            .swiper-wrapper {
            position: relative;
            width: 100%;
            height: 100%;
            z-index: 1;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-transition-property: -webkit-transform;
            transition-property: -webkit-transform;
            -o-transition-property: transform;
            transition-property: transform;
            transition-property: transform,-webkit-transform;
            -webkit-box-sizing: content-box;
            box-sizing: content-box;
        }
        .testimonial .testi_right .testi_slider .testi_item {
            background: #fff;
            padding: 40px;
            align-items: center;
            justify-content: space-between;
        }
        .testimonial .testi_right .testi_slider .testi_item .testi_thumb {
            text-align: center;
            padding-bottom: 25px;
        }

        @media (min-width: 768px) {
        .testimonial .testi_right .testi_slider .testi_item .testi_content {
            width: 75%;
        }
        }
        .testimonial .testi_right .testi_slider .testi_item .testi_content p {
            position: relative;
            line-height: 30px;
            font-size: 20px;
        }
        .testimonial .testi_right .testi_slider .testi_item .testi_content span {
            display: inline-block;
            color: #3d3c38;
            font-size: 17px;
            line-height: 28px;
        }
        .testimonial .testi_right .testi_slider .testi_item .testi_thumb img {
            box-shadow: 0px 12px 36px rgba(23, 34, 44, 0.12);
            border-radius: 12px;
            overflow: hidden;
        }

        @media (min-width: 768px) {
        .testimonial .testi_right .testi_slider .testi_item .testi_thumb {
            padding-bottom: 0;
            width: 20%;
        }
        }

        .testimonial .testi_right .testi_slider .testi_item {
            display: flex;
            flex-wrap: wrap;
        }
        .testi_slider_pagination  {
            display:none;
        }

        </style>

</head>

<body class="full-screen-slider">
        <!-- ========== HEADER ========== -->
        <header id="header" class="u-header u-header-left-aligned-nav">
            <div class="u-header__section">
                <!-- Topbar -->
                <div class="u-header-topbar py-2 d-none d-xl-block">
                    <div class="container">
                        <div class="d-flex align-items-center">
                            <div class="topbar-left">
                                <a href="#" class="text-gray-110 font-size-13 u-header-topbar__nav-link">Welcome to Arabian Pure</a>
                            </div>
                            <div class="topbar-right ml-auto">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                    <a href="http://bd.arabianpure.com/" class="u-header-topbar__nav-link">বাংলা</a>
                                    </li>

                                    <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                    <a href="{{route('tracking')}}" class="u-header-topbar__nav-link"><i class="ec ec-transport mr-1"></i> Track Your Order</a>
                                    </li>


                                    @if (!Auth::check())
                                    <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                        <!-- Account Sidebar Toggle Button -->
                                        <a id="sidebarNavToggler" href="{{route('register')}}" role="button" class="u-header-topbar__nav-link"
                                            aria-controls="sidebarContent"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                            data-unfold-event="click"
                                            data-unfold-hide-on-scroll="false"

                                            data-unfold-type="css-animation"
                                            data-unfold-animation-in="fadeInRight"
                                            data-unfold-animation-out="fadeOutRight"
                                            data-unfold-duration="500">
                                            <i class="ec ec-user mr-1"></i> Register <span class="text-gray-50">or</span>
                                        </a>
                                        <a href="{{route('login')}}" class="u-header-topbar__nav-link">Sign in</a>
                                        <!-- End Account Sidebar Toggle Button -->
                                    </li>
                                    @else
                                <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border"><a class="u-header-topbar__nav-link" href="{{route('user.profile.home')}}">My Account</a></li>
                                    @endif

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Topbar -->

                <!-- Logo-Search-header-icons -->
                <div class="py-2 py-xl-5 bg-primary-down-lg">
                    <div class="container my-0dot5 my-xl-0">
                        <div class="row align-items-center">
                            <!-- Logo-offcanvas-menu -->
                            <div class="col-auto">
                                <!-- Nav -->
                                <nav class="navbar navbar-expand u-header__navbar py-0 justify-content-xl-between max-width-270 min-width-270">
                                    <!-- Logo -->
                                <a class="order-1 order-xl-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-center" href="{{route('index')}}" aria-label="Electro">
                                        <img src="{{asset('images/'.$general->logo)}}" alt="logo">
                                    </a>
                                    <!-- End Logo -->

                                    <!-- Fullscreen Toggle Button -->
                                    <button id="sidebarHeaderInvokerMenu" type="button" class="navbar-toggler d-block btn u-hamburger mr-3 mr-xl-0"
                                        aria-controls="sidebarHeader"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                        data-unfold-event="click"
                                        data-unfold-hide-on-scroll="false"
                                        data-unfold-target="#sidebarHeader1"
                                        data-unfold-type="css-animation"
                                        data-unfold-animation-in="fadeInLeft"
                                        data-unfold-animation-out="fadeOutLeft"
                                        data-unfold-duration="500">
                                        <span id="hamburgerTriggerMenu" class="u-hamburger__box">
                                            <span class="u-hamburger__inner"></span>
                                        </span>
                                    </button>
                                    <!-- End Fullscreen Toggle Button -->
                                </nav>
                                <!-- End Nav -->

                                <!-- ========== HEADER SIDEBAR ========== -->
                                <aside id="sidebarHeader1" class="u-sidebar u-sidebar--left" aria-labelledby="sidebarHeaderInvokerMenu">
                                    <div class="u-sidebar__scroller">
                                        <div class="u-sidebar__container">
                                            <div class="u-header-sidebar__footer-offset pb-0">
                                                <!-- Toggle Button -->
                                                <div class="position-absolute top-0 right-0 z-index-2 pt-4 pr-7">
                                                    <button type="button" class="close ml-auto"
                                                        aria-controls="sidebarHeader"
                                                        aria-haspopup="true"
                                                        aria-expanded="false"
                                                        data-unfold-event="click"
                                                        data-unfold-hide-on-scroll="false"
                                                        data-unfold-target="#sidebarHeader1"
                                                        data-unfold-type="css-animation"
                                                        data-unfold-animation-in="fadeInLeft"
                                                        data-unfold-animation-out="fadeOutLeft"
                                                        data-unfold-duration="500">
                                                        <span aria-hidden="true"><i class="ec ec-close-remove text-gray-90 font-size-20"></i></span>
                                                    </button>
                                                </div>
                                                <!-- End Toggle Button -->

                                                <!-- Content -->
                                                <div class="js-scrollbar u-sidebar__body">
                                                    <div id="headerSidebarContent" class="u-sidebar__content u-header-sidebar__content">
                                                        <!-- Logo -->
                                                        <a class="d-flex ml-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-vertical" href="index.html" aria-label="Electro">
                                                            <img src="{{asset('images/'.$general->logo)}}" alt="logo">
                                                        </a>
                                                        <!-- End Logo -->

                                                        <!-- List -->
                                                        <ul id="headerSidebarList" class="u-header-collapse__nav">
                                                            <li class="u-has-submenu u-header-collapse__submenu">
                                                                <a class="nav-link u-header__nav-link pl-0" href="index.html">Home</a>
                                                            </li>
                                                            <!-- End Home Section -->

                                                            <!-- Fruits -->
                                                            <li class="u-has-submenu u-header-collapse__submenu">
                                                                <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="javascript:;" data-target="#Fruits" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="Fruits">Fruits</a>

                                                                <div id="Fruits" class="collapse" data-parent="#headerSidebarContent">
                                                                    <ul id="headerSidebarShopMenu" class="u-header-collapse__nav-list">
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Dates</a></li>
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Tin Fruit</a></li>
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Joytun Fruit</a></li>
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                            <!-- Fruits -->

                                                            <!-- Perfume -->
                                                            <li class="u-has-submenu u-header-collapse__submenu">
                                                                <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="javascript:;" data-target="#Perfume" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="Perfume">Perfume</a>

                                                                <div id="Perfume" class="collapse" data-parent="#headerSidebarContent">
                                                                    <ul id="headerSidebarShopMenu" class="u-header-collapse__nav-list">
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Arabian Ator</a></li>
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Arabian Wood</a></li>
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Bokhur</a></li>
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                            <!-- Perfume -->

                                                            <!-- Baby Zone -->
                                                            <li class="u-has-submenu u-header-collapse__submenu">
                                                                <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="javascript:;" data-target="#BabyZone" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="BabyZone">Baby Zone</a>

                                                                <div id="BabyZone" class="collapse" data-parent="#headerSidebarContent">
                                                                    <ul id="headerSidebarShopMenu" class="u-header-collapse__nav-list">
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Nestle NIDO</a></li>
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Baby Soap</a></li>
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Baby Lotion</a></li>
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Baby Diapers</a></li>
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Baby Oil</a></li>
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                            <!-- Baby Zone -->

                                                            <!-- Drinks -->
                                                            <li class="u-has-submenu u-header-collapse__submenu">
                                                                <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="javascript:;" data-target="#Drinks" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="Drinks">Drinks</a>

                                                                <div id="Drinks" class="collapse" data-parent="#headerSidebarContent">
                                                                    <ul id="headerSidebarShopMenu" class="u-header-collapse__nav-list">
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Tang</a></li>
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Arabian Coffee</a></li>
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Nestle Coffee</a></li>
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Zamzam Water</a></li>
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Saudi Milk</a></li>
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Vinegar</a></li>
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                            <!-- Drinks -->

                                                            <!-- Food -->
                                                            <li class="u-has-submenu u-header-collapse__submenu">
                                                                <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="javascript:;" data-target="#Food" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="Food">Food</a>

                                                                <div id="Food" class="collapse" data-parent="#headerSidebarContent">
                                                                    <ul id="headerSidebarShopMenu" class="u-header-collapse__nav-list">
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Joytun Oil</a></li>
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Honey</a></li>
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Cheez</a></li>
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Batter</a></li>
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Kaju Nut</a></li>
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Pesta Nut</a></li>
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Sunflower Seed</a></li>
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Honey Nuts</a></li>
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Chocolates</a></li>
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                            <!-- Food -->

                                                            <!-- Gift -->
                                                            <li class="u-has-submenu u-header-collapse__submenu">
                                                                <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="javascript:;" data-target="#Gift" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="Gift">Gift</a>

                                                                <div id="Gift" class="collapse" data-parent="#headerSidebarContent">
                                                                    <ul id="headerSidebarShopMenu" class="u-header-collapse__nav-list">
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Floor Carpet</a></li>
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Janamaz</a></li>
                                                                        <li><a class="nav-link u-header__sub-menu-nav-link" href="product-categories-7-column-full-width.html">Tasbih</a></li>
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                            <!-- Gift -->


                                                            <!-- Blog -->
                                                            <li class="u-has-submenu u-header-collapse__submenu">
                                                                <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="javascript:;" data-target="#headerSidebarShopCollapse" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="headerSidebarShopCollapse">Blog</a>

                                                                <div id="headerSidebarShopCollapse" class="collapse" data-parent="#headerSidebarContent">
                                                                    <ul id="headerSidebarShopMenu" class="u-header-collapse__nav-list">
                                                                        <!-- Single Product Extended -->
                                                                        <li><a class="u-header-collapse__submenu-nav-link" href="blog-v3.html">Blog</a></li>
                                                                        <!-- End Single Product Extended -->

                                                                        <!-- Single Product Fullwidth -->
                                                                        <li><a class="u-header-collapse__submenu-nav-link" href="single-blog-post.html">Single Blog Post</a></li>
                                                                        <!-- End Single Product Fullwidth -->
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                            <!-- End Blog -->

                                                            <!-- Contact Us -->
                                                            <li class="u-has-submenu u-header-collapse__submenu">
                                                                <a class="nav-link u-header__nav-link pl-0" href="contact-v1.html">Contact Us</a>
                                                            </li>
                                                            <!-- End Contact Us -->
                                                        </ul>
                                                        <!-- End List -->
                                                    </div>
                                                </div>
                                                <!-- End Content -->
                                            </div>
                                        </div>
                                    </div>
                                </aside>
                                <!-- ========== END HEADER SIDEBAR ========== -->
                            </div>
                            <!-- End Logo-offcanvas-menu -->
                            <!-- Search Bar -->
                            <div class="col d-none d-xl-block">
                                <form class="js-focus-state">
                                    <label class="sr-only" for="searchproduct">Search</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control py-2 pl-5 font-size-15 border-right-0 height-40 border-width-2 rounded-left-pill border-primary" name="email" id="searchproduct-item" placeholder="Search for Products" aria-label="Search for Products" aria-describedby="searchProduct1" required>
                                        <div class="input-group-append">

                                            <a class="btn btn-primary height-40 py-2 px-3 rounded-right-pill" href="#" id="searchProduct1">
                                                <span class="ec ec-search font-size-24"></span>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- End Search Bar -->
                            <!-- Header Icons -->
                            <div class="col col-xl-auto text-right text-xl-left pl-0 pl-xl-3 position-static">
                                <div class="d-inline-flex">
                                    <ul class="d-flex list-unstyled mb-0 align-items-center">
                                        <!-- Search -->
                                        <li class="col d-xl-none px-2 px-sm-3 position-static">
                                            <a id="searchClassicInvoker" class="font-size-22 text-gray-90 text-lh-1 btn-text-secondary" href="javascript:;" role="button"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="Search"
                                                aria-controls="searchClassic"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                                data-unfold-target="#searchClassic"
                                                data-unfold-type="css-animation"
                                                data-unfold-duration="300"
                                                data-unfold-delay="300"
                                                data-unfold-hide-on-scroll="true"
                                                data-unfold-animation-in="slideInUp"
                                                data-unfold-animation-out="fadeOut">
                                                <span class="ec ec-search"></span>
                                            </a>

                                            <!-- Input -->
                                            <div id="searchClassic" class="dropdown-menu dropdown-unfold dropdown-menu-right left-0 mx-2" aria-labelledby="searchClassicInvoker">
                                                <form class="js-focus-state input-group px-3">
                                                    <input class="form-control" type="search" placeholder="Search Product">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary px-3" type="button"><i class="font-size-18 ec ec-search"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- End Input -->
                                        </li>
                                        <!-- End Search -->
                                    <li class="col d-none d-xl-block"><a href="@if(Auth::check()) {{route('wishlists')}} @else {{route('login')}} @endif" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="Favorites"><i class="font-size-22 ec ec-favorites"></i></a></li>
                                        <li class="col d-xl-none px-2 px-sm-3"><a href="@if(!Auth::check()) {{route('login')}} @else {{route('user.profile.home')}} @endif" class="text-gray-90" data-toggle="tooltip" data-placement="top" title="My Account"><i class="font-size-22 ec ec-user"></i></a></li>

                                        <li class="col pr-xl-0 px-2 px-sm-3">
                                            <a href="{{ route('carts') }}" class="text-gray-90 position-relative d-flex " data-toggle="tooltip" data-placement="top" title="Cart">
                                                <i class="font-size-22 ec ec-shopping-bag"></i>
                                                <span class="bg-lg-down-black width-22 height-22 bg-primary position-absolute d-flex align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12" id="cart_count">

                                                    @if(isset($carts['id']))
                                                    @php
                                                    echo count($carts['id']);
                                                    @endphp

                                                    @else
                                                        0
                                                    @endif
                                                </span>

                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <!-- End Header Icons -->
                        </div>
                    </div>
                </div>
                <!-- End Logo-Search-header-icons -->





                <!-- Primary-menu-wide -->
                <div class="d-none d-xl-block bg-primary">
                    <div class="container">
                        <div class="min-height-45">
                            <!-- Nav -->
                            <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar u-header__navbar--wide u-header__navbar--no-space">
                                <!-- Navigation -->
                                <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                                    <ul class="navbar-nav u-header__navbar-nav">

                                        {{-- @if($main_menu)
                                            @foreach($main_menu as $menu)

                                            <li class="nav-item hs-has-sub-menu u-header__nav-item" data-event="hover" data-animation-in="slideInUp" data-animation-out="fadeOut"><a href="{{ $menu['link'] }}" class="nav-link u-header__nav-link u-header__nav-link-toggle" @if( $menu['child'] )  @endif>
                                                @if(Config::get('app.locale') == 'bd')

                                                    @if(!is_null($menu['label_bd']))
                                                        {{ $menu['label_bd'] }}
                                                    @else
                                                        {{ $menu['label'] }}
                                                    @endif

                                                @elseif(Config::get('app.locale') == 'en')
                                                    {{ $menu['label'] }}
                                                @endif


                                            </a>
                                            @if( $menu['child'] )
                                            <ul class="sub-menu hs-sub-menu u-header__sub-menu animated fadeOut" >
                                                @foreach( $menu['child'] as $child )
                                                    <li class=""><a href="{{ $child['link'] }}" class="nav-link u-header__sub-menu-nav-link" title="">{{ $child['label'] }}</a></li>
                                                @endforeach
                                            </ul><!-- /.sub-menu -->
                                            @endif
                                        </li>
                                            @endforeach
                                            @endif --}}


                                    </ul>
                                </div>
                                <!-- End Navigation -->
                            </nav>
                            <!-- End Nav -->
                        </div>
                    </div>
                </div>
                <!-- End Primary-menu-wide -->




            </div>
        </header>
        <!-- ========== END HEADER ========== -->

        <!-- ========== MAIN CONTENT ========== -->
        <div id="main_container">
        @yield('content')
        </div>
        <div class="container">
        <div class="col-12 col-wd-9gdot5">
        <ul class='row list-unstyled products-group no-gutters' id="search_container">

        </ul>
        </div>
        </div>
        <!-- ========== END MAIN CONTENT ========== -->

        <!-- ========== FOOTER ========== -->
        <footer>
            <!-- Footer-top-widget -->
            <div class="container d-none d-lg-block mb-3">
                <div class="row">
                    <div class="col-wd-3 col-lg-4">
                        <div class="widget-column">
                            <div class="border-bottom border-color-1 mb-5">
                                <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Featured Products</h3>
                            </div>
                            <ul class="list-unstyled products-group">
                                @php
                                    $featured_products = Product::where('featured', '1')->orderBy('id','desc')->skip(0)->take(3)->get();
                                @endphp
                                @foreach ($featured_products as $product)
                                    <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                                        <div class="col-auto">
                                            <a href="{{route('product.show',$product->slug)}}" class="d-block width-75 text-center">
                                                @php
                                                        $i = 1;
                                                    @endphp
                                                @if(!is_null($product->images))
                                                    @foreach($product->images as $image)
                                                        @if($i>0)
                                                            <img src="{{ asset('images/'.$image->image) }}" class="img-fluid">
                                                        @endif
                                                    @php
                                                        $i--;
                                                    @endphp
                                                    @endforeach
                                                @else
                                                <img src="{{asset('images/no-img.jpg')}}" class="img-fluid">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="col pl-4 d-flex flex-column">
                                            <h5 class="product-item__title mb-0"><a href="{{route('product.show',$product->slug)}}" class="text-blue font-weight-bold">{{$product->title}}</a></h5>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <div class="col-wd-3 col-lg-4">
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Onsale Products</h3>
                        </div>
                        <ul class="list-unstyled products-group">
                            @php
                                    $onsale_products = Product::where('onsale', '1')->orderBy('id','desc')->skip(0)->take(3)->get();
                                @endphp
                                @foreach ($onsale_products as $product)
                                    <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                                        <div class="col-auto">
                                            <a href="{{route('product.show',$product->slug)}}" class="d-block width-75 text-center">
                                                @php
                                                        $i = 1;
                                                    @endphp
                                                @if(!is_null($product->images))
                                                    @foreach($product->images as $image)
                                                        @if($i>0)
                                                            <img src="{{ asset('images/'.$image->image) }}" class="img-fluid">
                                                        @endif
                                                    @php
                                                        $i--;
                                                    @endphp
                                                    @endforeach
                                                @else
                                                <img src="{{asset('images/no-img.jpg')}}" class="img-fluid">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="col pl-4 d-flex flex-column">
                                            <h5 class="product-item__title mb-0"><a href="{{route('product.show',$product->slug)}}" class="text-blue font-weight-bold">{{$product->title}}</a></h5>
                                        </div>
                                    </li>
                                @endforeach
                        </ul>
                    </div>
                    <div class="col-wd-3 col-lg-4">
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Top Rated Products</h3>
                        </div>
                        <ul class="list-unstyled products-group">
                            @php
                                    $toprated_products = Product::where('toprated', '1')->orderBy('id','desc')->skip(0)->take(3)->get();
                                @endphp
                                @foreach ($toprated_products as $product)
                                    <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                                        <div class="col-auto">
                                            <a href="{{route('product.show',$product->slug)}}" class="d-block width-75 text-center">
                                                @php
                                                        $i = 1;
                                                    @endphp
                                                @if(!is_null($product->images))
                                                    @foreach($product->images as $image)
                                                        @if($i>0)
                                                            <img src="{{ asset('images/'.$image->image) }}" class="img-fluid">
                                                        @endif
                                                    @php
                                                        $i--;
                                                    @endphp
                                                    @endforeach
                                                @else
                                                <img src="{{asset('images/no-img.jpg')}}" class="img-fluid">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="col pl-4 d-flex flex-column">
                                            <h5 class="product-item__title mb-0"><a href="{{route('product.show',$product->slug)}}" class="text-blue font-weight-bold">{{$product->title}}</a></h5>
                                        </div>
                                    </li>
                                @endforeach
                        </ul>
                    </div>
                    <div class="col-wd-3 d-none d-wd-block">
                        <a href="shop.html" class="d-block"><img class="img-fluid" src="arabian-assets/img/100X100/04.jpg" alt="Image Description"></a>
                    </div>
                </div>
            </div>
            <!-- End Footer-top-widget -->
            <!-- Footer-newsletter -->
            <div class="bg-primary py-3">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-7 mb-md-3 mb-lg-0">
                            <div class="row align-items-center">
                                <div class="col-auto flex-horizontal-center">
                                    <i class="ec ec-newsletter font-size-40"></i>
                                    <h2 class="font-size-20 mb-0 ml-3">Sign up to Newsletter</h2>
                                </div>
                                <div class="col my-4 my-md-0">

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <!-- Subscribe Form -->
                            <form class="js-validate js-form-message">
                                <label class="sr-only" for="subscribeSrEmail">Email address</label>
                                <div class="input-group input-group-pill">
                                    <input type="email" class="form-control border-0 height-40" name="email" id="subscribeSrEmail" placeholder="Email address" aria-label="Email address" aria-describedby="subscribeButton" required
                                    data-msg="Please enter a valid email address.">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-dark btn-sm-wide height-40 py-2" id="subscribeButton">Sign Up</button>
                                    </div>
                                </div>
                            </form>
                            <!-- End Subscribe Form -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Footer-newsletter -->
            <!-- Footer-bottom-widgets -->
            <div class="pt-8 pb-4 bg-gray-13">
                <div class="bg-shape">
                    <img src="arabian-assets/img/bg.png" alt="bg-shape">
                </div>
                <div class="container mt-1">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="mb-6">
                                <a href="#" class="d-inline-block">
                                    <img src="{{asset('images/'.$general->logo)}}" alt="logo">
                                </a>
                            </div>
                            <div class="mb-4">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <i class="ec ec-support text-primary font-size-56"></i>
                                    </div>
                                    <div class="col pl-3">
                                        <div class="font-size-13 font-weight-light">Got questions? Call us 24/7!</div>
                                        <a href="tel:+{{$general->phone_number}}" class="font-size-20 text-gray-90">{{$general->phone_number}} </a>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <h6 class="mb-1 font-weight-bold">Contact info</h6>
                                <address class="">
                                    {{$general->address}}
                                </address>
                            </div>
                            <div class="my-4 my-md-4">
                                <ul class="list-inline mb-0 opacity-7">
                                    <li class="list-inline-item mr-0">
                                    <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="{{$general->facebook}}">
                                            <span class="fab fa-facebook-f btn-icon__inner"></span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item mr-0">
                                    <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="{{$general->google}}">
                                            <span class="fab fa-google btn-icon__inner"></span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item mr-0">
                                    <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="{{$general->twitter}}">
                                            <span class="fab fa-twitter btn-icon__inner"></span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="row">
                                <div class="col-12 col-md mb-4 mb-md-0">
                                    <h6 class="mb-3 font-weight-bold">Find it Fast</h6>
                                    <!-- List Group -->
                                    <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                                        {{-- @if($footer_left_menu)
											@foreach($footer_left_menu as $menu)

												<li><a class="list-group-item list-group-item-action" href="{{$menu['link']}}">
													@if(Config::get('app.locale') == 'bd')

										            @if(!is_null($menu['label_bd']))
										                {{ $menu['label_bd'] }}
										            @else
										                {{ $menu['label'] }}
										            @endif

											        @elseif(Config::get('app.locale') == 'en')
											            {{ $menu['label'] }}
											        @endif
												</a></li>

												@if($menu['child'])
													@foreach($menu['child'] as $child)
													<li><a class="list-group-item list-group-item-action" href="{{$child['link']}}">
														@if(Config::get('app.locale') == 'bd')

											            @if(!is_null($child['label_bd']))
											                {{ $child['label_bd'] }}
											            @else
											                {{ $child['label'] }}
											            @endif

												        @elseif(Config::get('app.locale') == 'en')
												            {{ $child['label'] }}
												        @endif
													</a></li>
													@endforeach
												@endif
											@endforeach

											@endif --}}

                                    </ul>
                                    <!-- End List Group -->
                                </div>



                                <div class="col-12 col-md mb-4 mb-md-0">
                                    <h6 class="mb-3 font-weight-bold">Customer Care</h6>
                                    <!-- List Group -->
                                    <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                                        {{-- @if($footer_right_menu)
											@foreach($footer_right_menu as $menu)

												<li><a class="list-group-item list-group-item-action" href="{{$menu['link']}}">
													@if(Config::get('app.locale') == 'bd')

										            @if(!is_null($menu['label_bd']))
										                {{ $menu['label_bd'] }}
										            @else
										                {{ $menu['label'] }}
										            @endif

											        @elseif(Config::get('app.locale') == 'en')
											            {{ $menu['label'] }}
											        @endif
												</a></li>

												@if($menu['child'])
													@foreach($menu['child'] as $child)
													<li><a class="list-group-item list-group-item-action" href="{{$child['link']}}">
														@if(Config::get('app.locale') == 'bd')

											            @if(!is_null($child['label_bd']))
											                {{ $child['label_bd'] }}
											            @else
											                {{ $child['label'] }}
											            @endif

												        @elseif(Config::get('app.locale') == 'en')
												            {{ $child['label'] }}
												        @endif
													</a></li>
													@endforeach
												@endif
											@endforeach

											@endif --}}

                                    </ul>
                                    <!-- End List Group -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Footer-bottom-widgets -->
            <!-- Footer-copy-right -->
            <div class="bg-gray-14 py-2">
                <div class="container">
                    <div class="flex-center-between d-block d-md-flex">
                    <div class="mb-3 mb-md-0">© <a href="#" class="font-weight-bold text-gray-90">{{$general->copyright}}</a></div>
                        <div class="text-md-right">
                            @php
                                $payment_method = Banner::where('short_code','payment_method')->first();
                            @endphp
                            <img src="{{asset('images/'.$payment_method->image)}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Footer-copy-right -->
        </footer>
        <!-- ========== END FOOTER ========== -->

        <!-- ========== SECONDARY CONTENTS ========== -->
        <!-- Account Sidebar Navigation -->
        <aside id="sidebarContent" class="u-sidebar" aria-labelledby="sidebarNavToggler">
            <div class="u-sidebar__scroller">
                <div class="u-sidebar__container">
                    <div class="js-scrollbar u-header-sidebar__footer-offset pb-3">
                        <!-- Toggle Button -->
                        <div class="d-flex align-items-center pt-4 px-7">
                            <button type="button" class="close ml-auto"
                                aria-controls="sidebarContent"
                                aria-haspopup="true"
                                aria-expanded="false"
                                data-unfold-event="click"
                                data-unfold-hide-on-scroll="false"
                                data-unfold-target="#sidebarContent"
                                data-unfold-type="css-animation"
                                data-unfold-animation-in="fadeInRight"
                                data-unfold-animation-out="fadeOutRight"
                                data-unfold-duration="500">
                                <i class="ec ec-close-remove"></i>
                            </button>
                        </div>
                        <!-- End Toggle Button -->

                        <!-- Content -->
                        <div class="js-scrollbar u-sidebar__body">
                            <div class="u-sidebar__content u-header-sidebar__content">
                                <form class="js-validate">
                                    <!-- Login -->
                                    <div id="login" data-target-group="idForm">
                                        <!-- Title -->
                                        <header class="text-center mb-7">
                                        <h2 class="h4 mb-0">Welcome Back!</h2>
                                        <p>Login to manage your account.</p>
                                        </header>
                                        <!-- End Title -->

                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <div class="js-form-message js-focus-state">
                                                <label class="sr-only" for="signinEmail">Email</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="signinEmailLabel">
                                                            <span class="fas fa-user"></span>
                                                        </span>
                                                    </div>
                                                    <input type="email" class="form-control" name="email" id="signinEmail" placeholder="Email" aria-label="Email" aria-describedby="signinEmailLabel" required
                                                    data-msg="Please enter a valid email address."
                                                    data-error-class="u-has-error"
                                                    data-success-class="u-has-success">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Form Group -->

                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <div class="js-form-message js-focus-state">
                                              <label class="sr-only" for="signinPassword">Password</label>
                                              <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="signinPasswordLabel">
                                                        <span class="fas fa-lock"></span>
                                                    </span>
                                                </div>
                                                <input type="password" class="form-control" name="password" id="signinPassword" placeholder="Password" aria-label="Password" aria-describedby="signinPasswordLabel" required
                                                   data-msg="Your password is invalid. Please try again."
                                                   data-error-class="u-has-error"
                                                   data-success-class="u-has-success">
                                              </div>
                                            </div>
                                        </div>
                                        <!-- End Form Group -->

                                        <div class="d-flex justify-content-end mb-4">
                                            <a class="js-animation-link small link-muted" href="javascript:;"
                                               data-target="#forgotPassword"
                                               data-link-group="idForm"
                                               data-animation-in="slideInUp">Forgot Password?</a>
                                        </div>

                                        <div class="mb-2">
                                            <button type="submit" class="btn btn-block btn-sm btn-primary transition-3d-hover">Login</button>
                                        </div>

                                        <div class="text-center mb-4">
                                            <span class="small text-muted">Do not have an account?</span>
                                            <a class="js-animation-link small" href="javascript:;"
                                               data-target="#signup"
                                               data-link-group="idForm"
                                               data-animation-in="slideInUp">Signup
                                            </a>
                                        </div>

                                        <div class="text-center">
                                            <span class="u-divider u-divider--xs u-divider--text mb-4">OR</span>
                                        </div>

                                        <!-- Login Buttons -->
                                        <div class="d-flex">
                                            <a class="btn btn-block btn-sm btn-soft-facebook transition-3d-hover mr-1" href="#">
                                              <span class="fab fa-facebook-square mr-1"></span>
                                              Facebook
                                            </a>
                                            <a class="btn btn-block btn-sm btn-soft-google transition-3d-hover ml-1 mt-0" href="#">
                                              <span class="fab fa-google mr-1"></span>
                                              Google
                                            </a>
                                        </div>
                                        <!-- End Login Buttons -->
                                    </div>

                                    <!-- Signup -->
                                    <div id="signup" style="display: none; opacity: 0;" data-target-group="idForm">
                                        <!-- Title -->
                                        <header class="text-center mb-7">
                                        <h2 class="h4 mb-0">Welcome to Electro.</h2>
                                        <p>Fill out the form to get started.</p>
                                        </header>
                                        <!-- End Title -->

                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <div class="js-form-message js-focus-state">
                                                <label class="sr-only" for="signupEmail">Email</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="signupEmailLabel">
                                                            <span class="fas fa-user"></span>
                                                        </span>
                                                    </div>
                                                    <input type="email" class="form-control" name="email" id="signupEmail" placeholder="Email" aria-label="Email" aria-describedby="signupEmailLabel" required
                                                    data-msg="Please enter a valid email address."
                                                    data-error-class="u-has-error"
                                                    data-success-class="u-has-success">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Input -->

                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <div class="js-form-message js-focus-state">
                                                <label class="sr-only" for="signupPassword">Password</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="signupPasswordLabel">
                                                            <span class="fas fa-lock"></span>
                                                        </span>
                                                    </div>
                                                    <input type="password" class="form-control" name="password" id="signupPassword" placeholder="Password" aria-label="Password" aria-describedby="signupPasswordLabel" required
                                                    data-msg="Your password is invalid. Please try again."
                                                    data-error-class="u-has-error"
                                                    data-success-class="u-has-success">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Input -->

                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <div class="js-form-message js-focus-state">
                                            <label class="sr-only" for="signupConfirmPassword">Confirm Password</label>
                                                <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="signupConfirmPasswordLabel">
                                                        <span class="fas fa-key"></span>
                                                    </span>
                                                </div>
                                                <input type="password" class="form-control" name="confirmPassword" id="signupConfirmPassword" placeholder="Confirm Password" aria-label="Confirm Password" aria-describedby="signupConfirmPasswordLabel" required
                                                data-msg="Password does not match the confirm password."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Input -->

                                        <div class="mb-2">
                                            <button type="submit" class="btn btn-block btn-sm btn-primary transition-3d-hover">Get Started</button>
                                        </div>

                                        <div class="text-center mb-4">
                                            <span class="small text-muted">Already have an account?</span>
                                            <a class="js-animation-link small" href="javascript:;"
                                                data-target="#login"
                                                data-link-group="idForm"
                                                data-animation-in="slideInUp">Login
                                            </a>
                                        </div>

                                        <div class="text-center">
                                            <span class="u-divider u-divider--xs u-divider--text mb-4">OR</span>
                                        </div>

                                        <!-- Login Buttons -->
                                        <div class="d-flex">
                                            <a class="btn btn-block btn-sm btn-soft-facebook transition-3d-hover mr-1" href="#">
                                                <span class="fab fa-facebook-square mr-1"></span>
                                                Facebook
                                            </a>
                                            <a class="btn btn-block btn-sm btn-soft-google transition-3d-hover ml-1 mt-0" href="#">
                                                <span class="fab fa-google mr-1"></span>
                                                Google
                                            </a>
                                        </div>
                                        <!-- End Login Buttons -->
                                    </div>
                                    <!-- End Signup -->

                                    <!-- Forgot Password -->
                                    <div id="forgotPassword" style="display: none; opacity: 0;" data-target-group="idForm">
                                        <!-- Title -->
                                        <header class="text-center mb-7">
                                            <h2 class="h4 mb-0">Recover Password.</h2>
                                            <p>Enter your email address and an email with instructions will be sent to you.</p>
                                        </header>
                                        <!-- End Title -->

                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <div class="js-form-message js-focus-state">
                                                <label class="sr-only" for="recoverEmail">Your email</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="recoverEmailLabel">
                                                            <span class="fas fa-user"></span>
                                                        </span>
                                                    </div>
                                                    <input type="email" class="form-control" name="email" id="recoverEmail" placeholder="Your email" aria-label="Your email" aria-describedby="recoverEmailLabel" required
                                                    data-msg="Please enter a valid email address."
                                                    data-error-class="u-has-error"
                                                    data-success-class="u-has-success">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Form Group -->

                                        <div class="mb-2">
                                            <button type="submit" class="btn btn-block btn-sm btn-primary transition-3d-hover">Recover Password</button>
                                        </div>

                                        <div class="text-center mb-4">
                                            <span class="small text-muted">Remember your password?</span>
                                            <a class="js-animation-link small" href="javascript:;"
                                               data-target="#login"
                                               data-link-group="idForm"
                                               data-animation-in="slideInUp">Login
                                            </a>
                                        </div>
                                    </div>
                                    <!-- End Forgot Password -->
                                </form>
                            </div>
                        </div>
                        <!-- End Content -->
                    </div>
                </div>
            </div>
        </aside>
        <!-- End Account Sidebar Navigation -->
        <!-- ========== END SECONDARY CONTENTS ========== -->

    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

           <!-- Go to Top -->
        <a class="js-go-to u-go-to" href="#"
            data-position='{"bottom": 15, "right": 15 }'
            data-type="fixed"
            data-offset-top="400"
            data-compensation="#header"
            data-show-effect="slideInUp"
            data-hide-effect="slideOutDown">
            <span class="fas fa-arrow-up u-go-to__inner"></span>
        </a>
        <!-- End Go to Top -->

        <!-- JS Global Compulsory -->
        <script src="{{asset('arabian-assets/vendor/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{asset('arabian-assets/vendor/jquery-migrate/dist/jquery-migrate.min.js')}}"></script>
        <script src="{{asset('arabian-assets/vendor/popper.js/dist/umd/popper.min.js')}}"></script>
        <script src="{{asset('arabian-assets/vendor/bootstrap/bootstrap.min.js')}}"></script>

        <!-- JS Implementing Plugins -->
        <script src="{{asset('arabian-assets/vendor/appear.js')}}"></script>
        <script src="{{asset('arabian-assets/vendor/jquery.countdown.min.js')}}"></script>
        <script src="{{asset('arabian-assets/vendor/hs-megamenu/src/hs.megamenu.js')}}"></script>
        <script src="{{asset('arabian-assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"></script>
        <script src="{{asset('arabian-assets/vendor/jquery-validation/dist/jquery.validate.min.js')}}"></script>
        <script src="{{asset('arabian-assets/vendor/fancybox/jquery.fancybox.min.js')}}"></script>
        <script src="{{asset('arabian-assets/vendor/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
        <script src="{{asset('arabian-assets/vendor/typed.js/lib/typed.min.js')}}"></script>
        <script src="{{asset('arabian-assets/vendor/slick-carousel/slick/slick.js')}}"></script>
        <script src="{{asset('arabian-assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
        <script src="{{asset('arabian-assets/vendor/appear.js')}}"></script>

        <!-- JS Implementing Plugins -->





        <!-- JS Electro -->
        <script src="{{asset('arabian-assets/js/hs.core.js')}}"></script>
        <script src="{{asset('arabian-assets/js/components/hs.countdown.js')}}"></script>
        <script src="{{asset('arabian-assets/js/components/hs.header.js')}}"></script>
        <script src="{{asset('arabian-assets/js/components/hs.hamburgers.js')}}"></script>
        <script src="{{asset('arabian-assets/js/components/hs.unfold.js')}}"></script>
        <script src="{{asset('arabian-assets/js/components/hs.focus-state.js')}}"></script>
        <script src="{{asset('arabian-assets/js/components/hs.malihu-scrollbar.js')}}"></script>
        <script src="{{asset('arabian-assets/js/components/hs.validation.js')}}"></script>
        <script src="{{asset('arabian-assets/js/components/hs.fancybox.js')}}"></script>
        <script src="{{asset('arabian-assets/js/components/hs.onscroll-animation.js')}}"></script>
        <script src="{{asset('arabian-assets/js/components/hs.slick-carousel.js')}}"></script>
        <script src="{{asset('arabian-assets/js/components/hs.show-animation.js')}}"></script>
        <script src="{{asset('arabian-assets/js/components/hs.go-to.js')}}"></script>
        <script src="{{asset('arabian-assets/js/components/hs.selectpicker.js')}}"></script>
        <script src="{{asset('arabian-assets/js/components/hs.quantity-counter.js')}}"></script>
        <script src="{{ asset('assets/js/swiper.min.js') }}"></script>

        <!-- JS Electro -->

        <script src="{{asset('arabian-assets/js/components/hs.range-slider.js')}}"></script>
        <script src="{{asset('arabian-assets/js/components/hs.scroll-nav.js')}}"></script>
        <script src="{{asset('arabian-assets/js/components/hs.svg-injector.js')}}"></script>









        <!-- JS Plugins Init. -->
        <script>
            $(window).on('load', function () {
                // initialization of HSMegaMenu component
                $('.js-mega-menu').HSMegaMenu({
                    event: 'hover',
                    direction: 'horizontal',
                    pageContainer: $('.container'),
                    breakpoint: 767.98,
                    hideTimeOut: 0
                });
            });

            $(document).on('ready', function () {
                // initialization of header
                $.HSCore.components.HSHeader.init($('#header'));

                // initialization of animation
                $.HSCore.components.HSOnScrollAnimation.init('[data-animation]');

                // initialization of unfold component
                $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
                    afterOpen: function () {
                        $(this).find('input[type="search"]').focus();
                    }
                });

                // initialization of HSScrollNav component
                $.HSCore.components.HSScrollNav.init($('.js-scroll-nav'), {
                  duration: 700
                });

                // initialization of popups
                $.HSCore.components.HSFancyBox.init('.js-fancybox');

                // initialization of countdowns
                var countdowns = $.HSCore.components.HSCountdown.init('.js-countdown', {
                    yearsElSelector: '.js-cd-years',
                    monthsElSelector: '.js-cd-months',
                    daysElSelector: '.js-cd-days',
                    hoursElSelector: '.js-cd-hours',
                    minutesElSelector: '.js-cd-minutes',
                    secondsElSelector: '.js-cd-seconds'
                });

                // initialization of malihu scrollbar
                $.HSCore.components.HSMalihuScrollBar.init($('.js-scrollbar'));

                // initialization of forms
                $.HSCore.components.HSFocusState.init();

                // initialization of form validation
                $.HSCore.components.HSValidation.init('.js-validate', {
                    rules: {
                        confirmPassword: {
                            equalTo: '#signupPassword'
                        }
                    }
                });

                // initialization of show animations
                $.HSCore.components.HSShowAnimation.init('.js-animation-link');

                // initialization of fancybox
                $.HSCore.components.HSFancyBox.init('.js-fancybox');

                // initialization of slick carousel
                $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');

                // initialization of go to
                $.HSCore.components.HSGoTo.init('.js-go-to');

                // initialization of hamburgers
                $.HSCore.components.HSHamburgers.init('#hamburgerTrigger');

                // initialization of unfold component
                $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
                    beforeClose: function () {
                        $('#hamburgerTrigger').removeClass('is-active');
                    },
                    afterClose: function() {
                        $('#headerSidebarList .collapse.show').collapse('hide');
                    }
                });

                $('#headerSidebarList [data-toggle="collapse"]').on('click', function (e) {
                    e.preventDefault();

                    var target = $(this).data('target');

                    if($(this).attr('aria-expanded') === "true") {
                        $(target).collapse('hide');
                    } else {
                        $(target).collapse('show');
                    }
                });

                // initialization of unfold component
                $.HSCore.components.HSUnfold.init($('[data-unfold-target]'));

                // initialization of select picker
                $.HSCore.components.HSSelectPicker.init('.js-select');

                // initialization of quantity counter
                $.HSCore.components.HSQantityCounter.init('.js-quantity');
                // initialization of forms
                $.HSCore.components.HSRangeSlider.init('.js-range-slider');
                 // banner slider
    var swiper = new Swiper('.banner-slider', {
        slidesPerView: 1,
        spaceBetween: 10,
        navigation: {
            nextEl: '.banner-slider-next',
            prevEl: '.banner-slider-prev',
        },
        speed: 1200,
        autoplay: {
            delay: 3200,
            disableOnInteraction: false,
        },
        loop: true
    });
    // banner bottom slider
    var swiper = new Swiper('.bb_slider_1, .bb_slider_2, .bb_slider_3', {
        slidesPerView: 1,
        spaceBetween: 10,
        speed: 1600,
        pagination: {
            el: '.bb_slider_pagination',
            clickable: true,
        },
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
        loop: true
    });

    // testimonial slider
    var swiper = new Swiper('.testi_slider', {
        slidesPerView: 1,
        spaceBetween: 0,
        speed: 1600,
        pagination: {
            el: '.testi_slider_pagination',
            clickable: true,
        },
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
        loop: true
    });
            });
        </script>


    @yield('extra_script')

    <!-- Main JS File -->
    <script src="{{asset('assets/js/printThis.js')}}"></script>
    <script src="{{ asset('js/notifIt.js') }}"></script>

</body>
</html>

<script type="text/javascript">
	@if(Session::has('success'))

        var message = '{{ Session::get('success') }}';
        notif({
        msg: message,
        type: "success"
        });

    @elseif(Session::has('danger'))

        var message = '{{ Session::get('danger') }}';
        notif({
        msg: message,
        type: "error"

        });

    @elseif($errors->any())

    var message = "@foreach($errors->all() as $error) <li>{{ $error }}</li>  @endforeach";
    notif({
    msg: message,
    type: "error"

    });

    @endif
</script>

<script>



    $(document).ready(function(){

        function addToCart() {

        $('.add_to_cart_button').click(function(event) {
        event.preventDefault();
        var product_id = $(this).closest( "#single_product_id" ).find('.product_id').val();


        var originalQty = $(this).closest( "#single_product_id" ).find('.quantity').val();
        var quantity = $(this).closest( "#single_product_id" ).find('.js-result').val();

        var selected_package = $(this).closest("#single_product_id").find('.filter-option-inner-inner').text();

        var position = selected_package.search('-');
        var package_length = selected_package.length;
        var price = selected_package.slice(position+2, package_length-2);
        var total_price = price*quantity;
        var ajaxurl = "@php echo route('carts.ajaxstore'); @endphp";

        console.log(quantity,product_id,price,total_price);


        $.ajax(
        {
            url: ajaxurl,   // request url
            data:{product_id: product_id, qtybutton:quantity,prc:price,price:total_price, quantity:originalQty } ,
            type: 'GET',
            success: function (data, status, xhr) {// success callback function
                console.log(data);
                var message = 'Product added to cart.';
                notif({
                msg: message,
                type: "success"
                });


                $('#cart_count').text(data.id.length);
                console.log(data.id.length);
            },
            error: function() {
                var message = "Error product don't added." ;
                notif({
                msg: message,
                type: "error"
                });
            }
        });

        // $.ajax({
        //     url: '/ajax/store/',
        //     data: {
        //         format: 'json'
        //     },
        //     error: function() {
        //         $('#info').html('<p>An error has occurred</p>');
        //     },
        //     dataType: 'jsonp',
        //     success: function(data) {
        //         var $title = $('<h1>').text(data.talks[0].talk_title);
        //         var $description = $('<p>').text(data.talks[0].talk_description);
        //         $('#info')
        //             .append($title)
        //             .append($description);
        //     },
        //     type: 'GET'
        // });
         });
        }

    addToCart();

    $('#searchproduct-item').keyup(function(event) {

    var search_keywords = $(this).val();

    var ajaxurl = "@php echo route('ajaxsearch'); @endphp";

    console.log(search_keywords);


    $.ajax({
        url: ajaxurl,   // request url
        data:{search: search_keywords} ,
        type: 'GET',
        success: function (data, status, xhr) {// success callback function
            $('#main_container').hide();
            let container = $('#search_container');
            container.empty();
            container.append(data);
            $.HSCore.components.HSSelectPicker.init('.js-select');
            $.HSCore.components.HSQantityCounter.init('.js-quantity');
            addToCart();



        },
            error: function() {
                var message = "Error product don't added." ;
                notif({
                msg: message,
                type: "error"
                });
            }
        });

    });




    });
</script>
@yield('script')

@else
error!! Contact with developer.
@endif
