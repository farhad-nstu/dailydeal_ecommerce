@php
use App\PopularProductSlider;
use App\PopularProductSliderImage;
use App\PpageBanner;
use App\Faq;
use App\TestimonialLeft;
use App\Testimonial;
use App\Banner;
use App\SectionSwitch;
use App\Counter;
@endphp

@extends('backend.layouts.master')

@section('content')

<div class="row">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div id="accordion">
  <div class="card">
    @include('backend.layouts.error')
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Add/Update General Information
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
            <form action="{{ route('admin.general.update', $general->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @if($general->logo != NULL)
                <div class="form-group">
                  <label for="image" class="col-form-label">Old Logo</label>
                  <div class="col-md-4">
                  <img src="{{ asset('images/'.$general->logo) }}" width="100">
                  </div>
                </div>
                @endif
                <div class="form-group">
                    <label for="logo" class="col-form-label">New Logo</label>
                    <div class="col-md-4">
                    <input id="logo" type="file" class="form-control" name="logo" value="{{ $general->logo }}">
                    </div>                   
                </div>

                <div class="form-group">
                    <label for="about">About For Footer</label>
                    <textarea class="form-control" id="about" rows="3" name="about">{{ $general->about }}</textarea>
                </div>

                <div class="form-group">
                    <label for="about_bd">কোম্পানি সম্পর্কে</label>
                    <textarea class="form-control" id="about_bd" rows="3" name="about_bd">{{ $general->about_bd }}</textarea>
                </div>

                <div class="form-group">
                    <label for="copyright" class="col-form-label">Copyright For Footer</label>
                    <input id="copyright" type="text" class="form-control" name="copyright" value="{{ $general->copyright }}">
                </div>

                <div class="form-group">
                    <label for="copyright_bd" class="col-form-label">কপিরাইট ফুটার এর জন্য</label>
                    <input id="copyright_bd" type="text" class="form-control" name="copyright_bd" value="{{ $general->copyright_bd }}">
                </div>

                <div class="form-group">
                    <label for="address" class="col-form-label">Address</label>
                    <input id="address" type="text" class="form-control" name="address" value="{{ $general->address }}">
                </div>

                <div class="form-group">
                    <label for="address_bd" class="col-form-label">ঠিকানা</label>
                    <input id="address_bd" type="text" class="form-control" name="address_bd" value="{{ $general->address_bd }}">
                </div>

                <div class="form-group">
                    <label for="email" class="col-form-label">Email</label>
                    <input id="email" type="text" class="form-control" name="email" value="{{ $general->email }}">
                </div>

                <div class="form-group">
                    <label for="phone_number" class="col-form-label">Phone Number</label>
                    <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{ $general->phone_number }}">
                </div>

                <div class="form-group">
                    <label for="phone_number_bd" class="col-form-label">ফোন নম্বর</label>
                    <input id="phone_number_bd" type="text" class="form-control" name="phone_number_bd" value="{{ $general->phone_number_bd }}">
                </div>

                <div class="form-group">
                    <label for="website" class="col-form-label">Website</label>
                    <input id="website" type="text" class="form-control" name="website" value="{{ $general->website }}">
                </div>
                <div class="form-group">
                    <label for="website" class="col-form-label">Meta Name | Title</label>
                    <input id="website" type="text" class="form-control" name="meta_name" value="{{ $general->meta_name }}">
                </div>
                <div class="form-group">
                    <label for="website" class="col-form-label">Meta Description</label>
                    <input id="website" type="text" class="form-control" name="meta_description" value="{{ $general->meta_description }}">
                </div>

                <div class="form-group">
                    <label for="facebook" class="col-form-label">Facebook Link</label>
                    <input id="facebook" type="text" class="form-control" name="facebook" value="{{ $general->facebook }}">
                </div>

                <div class="form-group">
                    <label for="twitter" class="col-form-label">Twitter Link</label>
                    <input id="twitter" type="text" class="form-control" name="twitter" value="{{ $general->twitter }}">
                </div>

                <div class="form-group">
                    <label for="linkedin" class="col-form-label">Linkedin Link</label>
                    <input id="linkedin" type="text" class="form-control" name="linkedin" value="{{ $general->linkedin }}">
                </div>

                <div class="form-group">
                    <label for="google" class="col-form-label">Google Link</label>
                    <input id="google" type="text" class="form-control" name="google" value="{{ $general->google }}">
                </div>

                {{-- <div class="form-group">
                    <label for="exampleFormControlSelect1">Default Language</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                      <option value="en" @if($general->default_language == 'en') selected="" @endif>English</option>
                      <option value="bd" @if($general->default_language == 'bd') selected="" @endif>Bangla</option>
                      
                    </select>
                </div> --}}

                

                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Update">
                </div>

                
            </form>
        </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Home Banners
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">

        <div class="form-group">
            <h4>Home Banners</h4>
        </div>
            <div id="accordion2">
              <div class="card">
              @php
                $popularproductsliders = PopularProductSlider::orderBy('serial', 'asc')->get();
              @endphp
              @foreach($popularproductsliders as $popularproductslider)

                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#popularslider{{$popularproductslider->id}}" aria-expanded="true" aria-controls="popularslider{{$popularproductslider->id}}">
                      > {{$popularproductslider->title}}
                    </button>
                  </h5>
                </div>

                <div id="popularslider{{$popularproductslider->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion2">
                  <div class="card-body">
                    <form action="{{route('admin.general.popularproductslider.update', $popularproductslider->id)}}" method="post" enctype="multipart/form-data">
                  @csrf
                      <div class="form-group">
                        <div class="row">
                          <div class="col">
                            <label for="title">Name</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{$popularproductslider->title}}" required="">
                          </div>
                          <div class="col">
                            <label for="serial">Serial</label>
                            <input type="number" class="form-control" id="serial" name="serial" required="" min="1" value="{{$popularproductslider->serial}}">
                          </div>
                        </div>
                        
                      </div>

                      <div class="form-group">
                        <label for="flashurl">URL</label>
                        <input type="text" class="form-control" id="flashurl" name="url" value="{{$popularproductslider->url}}" required="">
                      </div>
                      @php
                       $image = PopularProductSliderImage::where('popular_product_slider_id', $popularproductslider->id)->first();
                      @endphp
                      @if(!is_null($image))
                      <div class="form-group">
                        <label for="image">Old Image</label><br>
                        <img src="{{asset('images/'.$image->image)}}" width="100px">
                      </div>
                      @endif

                      <div class="form-group">
                        <label for="image">Image (416x624)px</label><br>
                        <input type="file" id="image" name="image">
                      </div>

                      
                      
                      <button type="submit" class="btn btn-primary">Update</button><br><br>
                    </form>
                      <a href="{{route('admin.general.popularproductslider.delete', $popularproductslider->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
 
                  </div>


                </div>

                @endforeach

              </div>
             
            </div>

            <p>
              <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#newpopularslide2" aria-expanded="false" aria-controls="newpopularslide2">
                Add new banner
              </button>
            </p>
            <div class="collapse" id="newpopularslide2">
              <div class="card card-body">
                <form action="{{route('admin.general.popularproductslider.store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                      <div class="form-group">
                        <div class="row">
                          <div class="col">
                            <label for="title">Name</label>
                            <input type="text" class="form-control" id="title" name="title" required="">
                          </div>
                          <div class="col">
                            <label for="serial">Serial</label>
                            <input type="number" class="form-control" id="serial" name="serial" required="" min="1">
                          </div>

                      </div>

                      <div class="form-group">
                        <label for="flashurl">URL</label>
                        <input type="text" class="form-control" id="flashurl" placeholder="http://" name="url" required="">
                      </div>


                      <div class="form-group">
                        <label for="image">Image(416x624)px</label><br>
                        <input type="file" id="image" name="image" required="">
                      </div>

                      
                      
                      <button type="submit" class="btn btn-primary">Add</button>
                    </form>
              </div>
            </div>

        

      </div>
    </div>
  </div>
  

  {{-- Product page banners start --}}


  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwoproductpagebanner" aria-expanded="false" aria-controls="collapseTwoproductpagebanner">
          Product Page Banners
        </button>
      </h5>
    </div>
    <div id="collapseTwoproductpagebanner" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">

        <div class="form-group">
            <h4>Product Page Banners</h4>
        </div>
            <div id="accordion2">
              <div class="card">
              @php
                $productpagebanners = PpageBanner::orderBy('title', 'asc')->get();
              @endphp
              @foreach($productpagebanners as $productpagebanner)

                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#popularslider{{$productpagebanner->id}}" aria-expanded="true" aria-controls="popularslider{{$productpagebanner->id}}">
                      > {{$productpagebanner->title}}
                    </button>
                  </h5>
                </div>

                <div id="popularslider{{$productpagebanner->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion2">
                  <div class="card-body">
                    <form action="{{route('admin.general.productpagebanner.update', $productpagebanner->id)}}" method="post" enctype="multipart/form-data">
                  @csrf
                      <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{$productpagebanner->title}}" required="">
                      </div>

                      <div class="form-group">
                        <label for="flashurl">URL</label>
                        <input type="text" class="form-control" id="flashurl" name="url" value="{{$productpagebanner->url}}" required="">
                      </div>

                      <div class="form-group">
                        <label for="image">Images</label><br>
                        <input type="file" id="image" name="image">
                      </div>

                      
                      
                      <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                    <br>
                    <a href="{{route('admin.general.productpagebanner.delete', $productpagebanner->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>

                  </div>


                </div>

                @endforeach

              </div>
             
            </div>

            <p>
              <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#newpopularslide" aria-expanded="false" aria-controls="newpopularslide">
                Add new Banner
              </button>
            </p>
            <div class="collapse" id="newpopularslide">
              <div class="card card-body">
                <form action="{{route('admin.general.productpagebanner.store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                      <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="" name="title" required="">
                      </div>

                      <div class="form-group">
                        <label for="flashurl">URL</label>
                        <input type="text" class="form-control" id="flashurl" placeholder="http://" name="url" required="">
                      </div>

                      <div class="form-group">
                        <label for="image">Images</label><br>
                        <input type="file" id="image" name="image" required="">
                      </div>

                      
                      
                      <button type="submit" class="btn btn-primary">Add</button>
                    </form>
              </div>
            </div>

        

      </div>
    </div>
  </div>

  {{-- Product page banners end --}}



 {{-- FAQ start --}}


  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwoproductfaq" aria-expanded="false" aria-controls="collapseTwoproductfaq">
          FAQ's
        </button>
      </h5>
    </div>
    <div id="collapseTwoproductfaq" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">

        <div class="form-group">
            <h4>FAQ's</h4>
        </div>
            <div id="accordion2">
              <div class="card">
              @php
                $faqs = Faq::orderBy('question', 'asc')->get();
              @endphp
              @foreach($faqs as $faq)

                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#faq{{$faq->id}}" aria-expanded="true" aria-controls="faq{{$faq->id}}">
                      > {{$faq->question}}
                    </button>
                  </h5>
                </div>

                <div id="faq{{$faq->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion2">
                  <div class="card-body">
                    <form action="{{route('admin.general.faq.update', $faq->id)}}" method="post" enctype="multipart/form-data">
                  @csrf
                      <div class="form-group">
                        <label for="question">Question</label>
                        <input type="text" class="form-control" id="question" name="question" value="{{$faq->question}}" required="">
                      </div>

                      <div class="form-group">
                        <label for="answer">Answer</label>
                        <input type="text" class="form-control" id="answer" name="answer" value="{{$faq->answer}}" required="">
                      </div>                      
                      
                      <label>বাংলায় :</label>
                       <div class="form-group">
                        <label for="question_bd">প্রশ্ন</label>
                        <input type="text" class="form-control" id="question_bd" name="question_bd" required="" value="{{$faq->question_bd}}">
                      </div>

                      <div class="form-group">
                        <label for="answer_bd">উত্তর</label>
                        <input type="text" class="form-control" id="answer_bd" name="answer_bd" required="" value="{{$faq->answer_bd}}">
                      </div>  

                      <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                    <br>
                    <a href="{{route('admin.general.faq.delete', $faq->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>

                  </div>


                </div>

                @endforeach

              </div>
             
            </div>

            <p>
              <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#newfaq" aria-expanded="false" aria-controls="newfaq">
                Add new FAQ
              </button>
            </p>
            <div class="collapse" id="newfaq">
              <div class="card card-body">
                <form action="{{route('admin.general.faq.store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                      <div class="form-group">
                        <label for="question">Question</label>
                        <input type="text" class="form-control" id="question" name="question" required="">
                      </div>

                      <div class="form-group">
                        <label for="answer">Answer</label>
                        <input type="text" class="form-control" id="answer" name="answer" required="">
                      </div> 

                      <label>বাংলায় :</label>
                       <div class="form-group">
                        <label for="question_bd">প্রশ্ন</label>
                        <input type="text" class="form-control" id="question_bd" name="question_bd" required="">
                      </div>

                      <div class="form-group">
                        <label for="answer_bd">উত্তর</label>
                        <input type="text" class="form-control" id="answer_bd" name="answer_bd" required="">
                      </div>   

                      
                      
                      <button type="submit" class="btn btn-primary">Add</button>
                    </form>
              </div>
            </div>

        

      </div>
    </div>
  </div>

  {{-- FAQ end --}}

  {{-- Testimonial start --}}


  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwotestimonial" aria-expanded="false" aria-controls="collapseTwotestimonial">
          Testimonial
        </button>
      </h5>
    </div>
    <div id="collapseTwotestimonial" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">

        @php
          $testimonialleft = TestimonialLeft::find(1);
        @endphp
        <form action="{{route('admin.general.testimonialleft.update', $testimonialleft->id)}}" method="post">
        @csrf
        <div class="form-group">
            <h4>Testimonial Left Field</h4>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $testimonialleft->title }}" required="">
            </div>

            <div class="col">
            <label for="title_bd">টাইটেল</label>
            <input type="text" class="form-control" id="title_bd" name="title_bd" value="{{ $testimonialleft->title_bd }}" required="">
            </div>
          </div>
          
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col">
              <label for="description">Description</label>
              <textarea class="form-control" id="description" name="description" required="">{{ $testimonialleft->description }}</textarea>
            </div>

            <div class="col">
              <label for="description_bd">বিবরণ</label>
              <textarea class="form-control" id="description_bd" name="description_bd" required="">{{ $testimonialleft->description_bd }}</textarea>
            </div>
          </div>
          
        </div>                      
        
        <button type="submit" class="btn btn-primary">Update</button>


        </form>
        <br><br>
        <div class="form-group">
          <h4>Testimonials</h4>
        </div>
            <div id="accordion2">
              <div class="card">
              @php
                $testimonials = Testimonial::orderBy('id', 'desc')->get();
              @endphp
              @foreach($testimonials as $testimonial)

                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#testimonial{{$testimonial->id}}" aria-expanded="true" aria-controls="testimonial{{$testimonial->id}}">
                      > {{$testimonial->name}}
                    </button>
                  </h5>
                </div>

                <div id="testimonial{{$testimonial->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion2">
                  <div class="card-body">
                    <form action="{{route('admin.general.testimonial.update', $testimonial->id)}}" method="post" enctype="multipart/form-data">
                  @csrf
                      <div class="form-group">
                        <div class="row">
                          <div class="col">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$testimonial->name}}" required="">
                          </div>

                          <div class="col">
                            <label for="name_bd">নাম</label>
                            <input type="text" class="form-control" id="name_bd" name="name_bd" value="{{$testimonial->name_bd}}" required="">
                          </div>
                        </div>
                        
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col">
                            <label for="comment">Comment</label>
                            <input type="text" class="form-control" id="comment" name="comment" value="{{$testimonial->comment}}" required="">
                          </div>

                          <div class="col">
                            <label for="comment_bd">মন্তব্য</label>
                            <input type="text" class="form-control" id="comment_bd" name="comment_bd" value="{{$testimonial->comment_bd}}" required="">
                          </div>
                        </div>
                        
                      </div>

                      <div class="form-group">
                        <label for="image">Images</label><br>
                        <input type="file" id="image" name="image">
                      </div>

                      
                      
                      <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                    <br>
                    <a href="{{route('admin.general.testimonial.delete', $testimonial->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>

                  </div>


                </div>

                @endforeach

              </div>
             
            </div>

            <p>
              <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#newtestmonial" aria-expanded="false" aria-controls="newtestmonial">
                Add New Testimonial
              </button>
            </p>
            <div class="collapse" id="newtestmonial">
              <div class="card card-body">
                <form action="{{route('admin.general.testimonial.store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                      <div class="form-group">
                        <div class="row">
                          <div class="col">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"  required="">
                          </div>

                          <div class="col">
                            <label for="name_bd">নাম</label>
                            <input type="text" class="form-control" id="name_bd" name="name_bd"  required="">
                          </div>
                        </div>
                        
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col">
                            <label for="comment">Comment</label>
                            <input type="text" class="form-control" id="comment" name="comment"  required="">
                          </div>

                          <div class="col">
                            <label for="comment_bd">মন্তব্য</label>
                            <input type="text" class="form-control" id="comment_bd" name="comment_bd"  required="">
                          </div>
                        </div>
                        
                      </div>

                      <div class="form-group">
                        <label for="image">Images</label><br>
                        <input type="file" id="image" name="image">
                      </div>

                      
                      
                      <button type="submit" class="btn btn-primary">Add</button>
                    </form>
              </div>
            </div>

        

      </div>
    </div>
  </div>

  {{-- Testimonial end --}}



  {{-- Home Banner Section Start --}}

  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwobannersmanage" aria-expanded="false" aria-controls="collapseTwobannersmanage">
          Banners
        </button>
      </h5>
    </div>
    <div id="collapseTwobannersmanage" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">

        <div class="form-group">
            <h4>Banner Manage</h4>
        </div>
            <div id="accordion2">
              <div class="card">
              @php
                $banners = Banner::orderBy('title', 'asc')->get();
              @endphp
              @foreach($banners as $banner)

                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#banners{{$banner->id}}" aria-expanded="true" aria-controls="banners{{$banner->id}}">
                      > {{$banner->title}}
                    </button>
                  </h5>
                </div>

                <div id="banners{{$banner->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion2">
                  <div class="card-body">
                    <form action="{{route('admin.general.banner.update', $banner->id)}}" method="post" enctype="multipart/form-data">
                  @csrf
                      <div class="form-group">
                        <div class="row">
                          <div class="col">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{$banner->title}}" required="">
                          </div>

                          <div class="col">
                            <label for="title_bd">টাইটেল</label>
                            <input type="text" class="form-control" id="title_bd" name="title_bd" value="{{$banner->title_bd}}" required="">
                          </div>
                        </div>
                        
                      </div>

                      <div class="form-group">
                        <label for="flashurl">URL</label>
                        <input type="text" class="form-control" id="flashurl" name="url" value="{{$banner->url}}" required="">
                      </div>

                      <div class="form-group">
                        <label for="image">Images</label><br>
                        <input type="file" id="image" name="image">
                      </div>

                      <div class="form-group">
                        <label for="shortcode">Short Code</label>
                        <input type="text" class="form-control" id="shortcode" value="{{$banner->short_code}}" >
                      </div>
                      
                      <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                    <br>
                    {{-- <a href="{{route('admin.general.banner.delete', $banner->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a> --}}

                  </div>


                </div>

                @endforeach

              </div>
             
            </div>

            <p>
              <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#newbannercreate" aria-expanded="false" aria-controls="newbannercreate">
                Add new Banner
              </button>
            </p>
            <div class="collapse" id="newbannercreate">
              <div class="card card-body">
                <form action="{{route('admin.general.banner.store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                      <div class="form-group">
                        <div class="row">
                          <div class="col">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required="">
                          </div>

                          <div class="col">
                            <label for="title_bd">টাইটেল</label>
                            <input type="text" class="form-control" id="title_bd" name="title_bd" required="">
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="flashurl">URL</label>
                        <input type="text" class="form-control" id="flashurl" name="url" required="">
                      </div>

                      <div class="form-group">
                        <label for="image">Images</label><br>
                        <input type="file" id="image" name="image">
                      </div>

                      <div class="form-group">
                        <label for="shortcode">Short Code</label>
                        <input type="text" class="form-control" id="shortcode" name="short_code">
                      </div>
                      
                      <button type="submit" class="btn btn-primary">Add</button>
                    </form>
              </div>
            </div>

        

      </div>
    </div>
  </div>


  {{-- Home Banner section End --}}




  {{-- Banner Counter Section Start --}}

  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsecounter" aria-expanded="false" aria-controls="collapsecounter">
          Counter Section Manage
        </button>
      </h5>
    </div>
    <div id="collapsecounter" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">

        @php
          $counter = Counter::find(1);
        @endphp
        <form action="{{route('admin.general.counter.update')}}" method="post">
          @csrf
          <div class="form-group">
            <label for="exclusive_categories">Exclusive Categories</label>
            <input type="text" name="exclusive_categories" id="exclusive_categories" value="{{$counter->exclusive_categories}}"><small> Number only</small>
          </div>

          <div class="form-group">
            <label for="products_accessories">Products & Accessories</label>
            <input type="text" name="products_accessories" id="products_accessories" value="{{$counter->products_accessories}}"><small> Number only</small>
          </div>
          

          <div class="form-group">
            <label for="happy_customer">Happy customer</label>
            <input type="text" name="happy_customer" id="happy_customer" value="{{$counter->happy_customer}}"><small> Number only</small>
          </div>

          <div class="form-group">
            <input type="submit" value="update">
          </div>
          
        </form>

        <form action="{{route('admin.general.counter.automatic')}}" method="post">
          @csrf
          {{-- Check button --}}
          <label style="margin-right: 20px;">Automatic </label>
          <div class="switch-button switch-button-lg">

              <input type="checkbox" 

              @if(Counter::find(1)->automatic == 1)
                checked=""
              @endif
              
               name="automatic_counter" id="automatic_counter"><span>
          <label for="automatic_counter"></label></span>
          </div><input type="submit" class="btn btn-success" value="Save" style="margin-left: 20px">
          </form>

        

      </div>
    </div>
  </div>


  {{-- Home Banner section End --}}

    {{-- Home Banner Section Start --}}

  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwosectiononoffswitch" aria-expanded="false" aria-controls="collapseTwosectiononoffswitch">
          Section On/Off switch
        </button>
      </h5>
    </div>
    <div id="collapseTwosectiononoffswitch" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">

        <div class="form-group">
            <h4>Frontend Manage</h4>
        </div>
            <div id="accordion2">
              <div class="card">
                <form action="{{route('admin.general.featured.switch')}}" method="post">
                @csrf
                {{-- Check button --}}
                <label style="margin-right: 20px;">Home Page Featured Section</label>
                <div class="switch-button switch-button-lg">

                    <input type="checkbox" 

                    @if(SectionSwitch::find(1)->action == 1)
                      checked=""
                    @endif

                     name="featured_home" id="featured_home"><span>
                <label for="featured_home"></label></span>
                </div><input type="submit" class="btn btn-success" value="Save" style="margin-left: 20px">
                </form>

                <br><br>


                <form action="{{route('admin.general.shopandsave.switch')}}" method="post">
                @csrf
                {{-- Check button --}}
                <label style="margin-right: 20px;">Shop And Save Big Banner</label>
                <div class="switch-button switch-button-lg">

                    <input type="checkbox" 

                    @if(SectionSwitch::find(4)->action == 1)
                      checked=""
                    @endif
                    
                     name="shop_save" id="shop_save"><span>
                <label for="shop_save"></label></span>
                </div><input type="submit" class="btn btn-success" value="Save" style="margin-left: 20px">
                </form>


                <br><br>


                <form action="{{route('admin.general.home.category.switch')}}" method="post">
                @csrf
                {{-- Check button --}}
                <label style="margin-right: 20px;">Home Category Section</label>
                <div class="switch-button switch-button-lg">

                    <input type="checkbox" 

                    @if(SectionSwitch::find(5)->action == 1)
                      checked=""
                    @endif
                    
                     name="home_category" id="home_category"><span>
                <label for="home_category"></label></span>
                </div><input type="submit" class="btn btn-success" value="Save" style="margin-left: 20px">
                </form>

                <br><br>

                <form action="{{route('admin.general.home.popularproduct.switch')}}" method="post">
                @csrf
                {{-- Check button --}}
                <label style="margin-right: 20px;">Home Popular Product Slider</label>
                <div class="switch-button switch-button-lg">

                    <input type="checkbox" 

                    @if(SectionSwitch::find(6)->action == 1)
                      checked=""
                    @endif
                    
                     name="home_popular_product" id="home_popular_product"><span>
                <label for="home_popular_product"></label></span>
                </div><input type="submit" class="btn btn-success" value="Save" style="margin-left: 20px">
                </form>


                <br><br>

                <form action="{{route('admin.general.home.slider.switch')}}" method="post">
                @csrf
                {{-- Check button --}}
                <label style="margin-right: 20px;">Home Big Slider</label>
                <div class="switch-button switch-button-lg">

                    <input type="checkbox" 

                    @if(SectionSwitch::find(7)->action == 1)
                      checked=""
                    @endif
                    
                     name="home_slider" id="home_slider"><span>
                <label for="home_slider"></label></span>
                </div><input type="submit" class="btn btn-success" value="Save" style="margin-left: 20px">
                </form>


                <br><br>

                <form action="{{route('admin.general.home.testimonial.switch')}}" method="post">
                @csrf
                {{-- Check button --}}
                <label style="margin-right: 20px;">Home Testimonial</label>
                <div class="switch-button switch-button-lg">

                    <input type="checkbox" 

                    @if(SectionSwitch::find(8)->action == 1)
                      checked=""
                    @endif
                    
                     name="home_testimonial" id="home_testimonial"><span>
                <label for="home_testimonial"></label></span>
                </div><input type="submit" class="btn btn-success" value="Save" style="margin-left: 20px">
                </form>


                <br><br>

                <form action="{{route('admin.general.home.paymentbanner.switch')}}" method="post">
                @csrf
                {{-- Check button --}}
                <label style="margin-right: 20px;">Home Payment Banner</label>
                <div class="switch-button switch-button-lg">

                    <input type="checkbox" 

                    @if(SectionSwitch::find(9)->action == 1)
                      checked=""
                    @endif
                    
                     name="home_paymentbanner" id="home_paymentbanner"><span>
                <label for="home_paymentbanner"></label></span>
                </div><input type="submit" class="btn btn-success" value="Save" style="margin-left: 20px">
                </form>


                <br><br>

                <form action="{{route('admin.general.home.counter.switch')}}" method="post">
                @csrf
                {{-- Check button --}}
                <label style="margin-right: 20px;">Home Counter</label>
                <div class="switch-button switch-button-lg">

                    <input type="checkbox" 

                    @if(SectionSwitch::find(10)->action == 1)
                      checked=""
                    @endif
                    
                     name="home_counter" id="home_counter"><span>
                <label for="home_counter"></label></span>
                </div><input type="submit" class="btn btn-success" value="Save" style="margin-left: 20px">
                </form>


              </div>
             
            </div>
        

      </div>
    </div>
  </div>


  {{-- Home Banner section End --}}

  </div>
</div>

</div>

@endsection