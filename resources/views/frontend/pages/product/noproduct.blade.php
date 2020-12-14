@extends('frontend.layouts.home')

@section('content')

    <div class="container">
        <div class="row mb-8">
            <div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">
                <div class="mb-6 border border-width-2 border-color-3 borders-radius-6">
                    <!-- List -->
                    <ul id="sidebarNav" class="list-unstyled mb-0 sidebar-navbar view-all">
                        <li><div class="dropdown-title">Browse Categories</div></li>
                        @foreach(App\Category::orderBy('name','asc')->where('parent_id',null)->get() as $category)
                        <li>
                            <a class="dropdown-toggle dropdown-toggle-collapse" href="javascript:;" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="sidebarNav1Collapse-{{$category->id}}" data-target="#sidebarNav1Collapse-{{$category->id}}">
                            {{$category->name}}</span>
                            </a>

                            <div id="sidebarNav1Collapse-{{$category->id}}" class="collapse" data-parent="#sidebarNav">
                                <ul id="sidebarNav1" class="list-unstyled dropdown-list">
                                <li><a class="dropdown-item" href="{{route('category.show',$category->slug)}}">{{$category->name}}</a></li>

                                    <!-- Menu List -->
                                    @foreach(App\Category::orderBy('name','asc')->where('parent_id', $category->id)->get() as $child)
                                <li><a class="dropdown-item" href="{{route('category.show',$child->slug)}}">{{$child->name}}</a></li>
                                    @endforeach
                                    <!-- End Menu List -->
                                </ul>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <!-- End List -->
                </div>
                <div class="mb-6">
                    
                    
                    <div class="range-slider">
                        <form action="{{route('product.short.price')}}" method="get">
                        <h4 class="font-size-14 mb-3 font-weight-bold">Price</h4>
                        <!-- Range Slider -->
                        <input class="js-range-slider" type="text"
                        data-extra-classes="u-range-slider u-range-slider-indicator u-range-slider-grid"
                        data-type="double"
                        data-grid="false"
                        data-hide-from-to="true"
                        data-prefix="$"
                        data-min="0"
                        data-max="3456"
                        data-from="0"
                        data-to="3456"
                        data-result-min="#rangeSliderExample3MinResult"
                        data-result-max="#rangeSliderExample3MaxResult" name="filter_price_range_input">
                        <!-- End Range Slider -->
                        <div class="mt-1 text-gray-111 d-flex mb-4">
                            <span class="mr-0dot5">Price: </span>
                            <span>$</span>
                            <span id="rangeSliderExample3MinResult" class=""></span>
                            <span class="mx-0dot5"> — </span>
                            <span>$</span>
                            <span id="rangeSliderExample3MaxResult" class=""></span>
                        </div>
                        <button type="submit" class="btn px-4 btn-primary-dark-w py-2 rounded-lg">Filter</button>
                        </form>
                    </div>
                </div>
                
            </div>
            <div class="col-xl-9 col-wd-9gdot5">
                
                <!-- Shop-control-bar -->
                <div class="bg-gray-1 flex-center-between borders-radius-9 py-1">
                    <div class="d-xl-none">
                        <!-- Account Sidebar Toggle Button -->
                        <a id="sidebarNavToggler1" class="btn btn-sm py-1 font-weight-normal" href="javascript:;" role="button"
                            aria-controls="sidebarContent1"
                            aria-haspopup="true"
                            aria-expanded="false"
                            data-unfold-event="click"
                            data-unfold-hide-on-scroll="false"
                            data-unfold-target="#sidebarContent1"
                            data-unfold-type="css-animation"
                            data-unfold-animation-in="fadeInLeft"
                            data-unfold-animation-out="fadeOutLeft"
                            data-unfold-duration="500">
                            {{-- <i class="fas fa-sliders-h"></i> <span class="ml-1">Filters</span> --}}
                        </a>
                        <!-- End Account Sidebar Toggle Button -->
                    </div>
                    
                    <div class="d-flex float-right">
                        <form method="get">
                            <!-- Select -->
                            <select class="js-select selectpicker dropdown-select max-width-200 max-width-160-sm right-dropdown-0 px-2 px-xl-0"
                                data-style="btn-sm bg-white font-weight-normal py-2 border text-gray-20 bg-lg-down-transparent border-lg-down-0" onchange="location = this.value;">
                                <option value="{{route('products')}}">Default sorting</option>
                                <option value="{{route('product.short.newest')}}">Sort by latest</option>
                            </select>
                            <!-- End Select -->
                        </form>
                        
                    </div>
                    
                </div>
                <!-- End Shop-control-bar -->
                <!-- Shop Body -->
                <!-- Tab Content -->
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade pt-2 show active" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab" data-target-group="groups">
                        <ul class="row list-unstyled products-group no-gutters">
                            Sorry there is no product.
                            
                        </ul>
                    </div>
                </div>
                <!-- End Tab Content -->
                <!-- End Shop Body -->
                <!-- Shop Pagination -->
                <nav class="d-md-flex justify-content-between align-items-center border-top pt-3" aria-label="Page navigation example">
                    
                </nav>
                <!-- End Shop Pagination -->
            </div>
        </div>
        
    </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->

@endsection

@section('extra_script')
<script src="{{asset('assets/js/nouislider.min.js')}}"></script>

@endsection