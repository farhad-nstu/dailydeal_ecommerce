@php
use App\Category;
use App\Brand;
$categories = Category::orderBy('name', 'asc')->get();
$main_categories = Category::orderBy('name','asc')->where('parent_id', Null)->get();
$sub_categories = Category::orderBy('name','asc')->whereNotNull('parent_id')->get();
$brands = Brand::orderBy('name', 'asc')->get();
@endphp

@extends('backend.layouts.vendormaster')

@section('content')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/drug-drop-image-upload/image-uploader.css') }}">
@endsection

@section('save_button')
    <a href="#" id="save_button">Add</a>
@endsection

<div class="row">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    
    <div class="card">
        <h5 class="card-header">Add New Product</h5>
        <div class="card-body">
            @include('backend.layouts.error')
            <form action="{{ route('vendor.product.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <div class="row">
                    <div class="col">
                    <label for="name" class="col-form-label">Title*</label>
                    <input id="name" type="text" class="form-control" name="title" required="">
                    </div>
                    <div class="col">
                    <label for="name" class="col-form-label">নাম*</label>
                    <input id="name" type="text" class="form-control" name="title_bd" >
                    </div>

                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                    <div class="col">
                    <label for="description">Description*</label>
                    <textarea class="form-control" id="description" rows="3" name="description" required=""></textarea>
                    </div>
                    
                    <div class="col">
                    <label for="description">বিবরণ*</label>
                    <textarea class="form-control" id="description" rows="3" name="description_bd" ></textarea>
                    </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                    <div class="col">
                    <label for="specifications">Specifications</label>
                    <textarea class="form-control" id="specifications" rows="3" name="specifications"></textarea>
                    </div>
                    <div class="col">
                    <label for="specifications">স্পেসিফিকেশন্স</label>
                    <textarea class="form-control" id="specifications" rows="3" name="specifications_bd"></textarea>
                    </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="price" class="col-form-label" >Price*</label>
                    <input id="price" type="number" class="form-control" name="price" required="">
                </div>

                <div class="form-group">
                    <label for="offer_price" class="col-form-label">Offer Price</label>
                    <input id="offer_price" type="number" class="form-control" name="offer_price">
                </div>

                <div class="form-group">
                    <label for="quantity" class="col-form-label">Quantity*</label>
                    <input id="quantity" type="number" class="form-control" name="quantity" required="">
                </div>
                <label>Images</label>
                <div class="input-images"></div>

                <div class="form-group">
                    <label for="sku" class="col-form-label">SKU / Product Code</label>
                    <input id="sku" type="text" class="form-control" name="sku">
                </div>

                <div class="form-group">
                    <label for="category">Category*</label>
                    <select class="form-control" id="category" name="category" required="">
                        <option value="">Select Category</option>
                    @foreach($main_categories as $main_category)
                       <option value="{{$main_category->id}}" style="font-weight: 700;" >{{ $main_category->name }} </option>
                        @foreach($sub_categories as $sub_category)
                            
                                <option value="{{$sub_category->id}}">- {{ $sub_category->name }} </option>
                            
                            
                        @endforeach
                    @endforeach
                      
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="brand">Brand</label>
                    <select class="form-control" id="brand" name="brand">
                        <option value="">Select Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                      
                    </select>
                  </div>


                {{-- <div class="form-group">
                <label class="col-form-label">Attributes</label><br>
               
                @foreach($attributes as $attribute)

                    @php
                      $attribute_ids = unserialize($attributeset->attribute_id);
                    @endphp


                    @foreach ($attribute_ids as $attribute_id)
                          @if ($attribute->id == $attribute_id)
                              
                            <b>{{ $attribute->name }}</b>
                            <input type="hidden" name="attribute_set_id" value="{{ $attributeset->id }}">
                            <input type="hidden" name="attributes_id[]" value="{{ $attribute->id }}">
                             <div class="form-check">
                              @php
                                $options = unserialize($attribute->options);
                              @endphp
                              

                              @foreach($options as $option)
                                
                                <input class="form-check-input" type="checkbox" id="gridCheck" value="{{ $option }}" name="attribute_options[]">
                                 <label class="form-check-label" for="gridCheck">
                                {{ $option }}
                              </label>
                              <br>
                              @endforeach
                            

                              </div>
                             
                              <br>

                          @endif
                    @endforeach



                    
                @endforeach


                
                </div> --}}


                <div class="field_wrapper">
                    <div class="form-group col-md-8" style="padding-left: 0">
                        <label>Add Attribute</label><br>
                        <label style="font-size: 13px;">Title (Ex Color)</label>

                        <input type="text" name="attribute_name[]" class="form-control" placeholder="Title" /><br>
                        <label style="font-size: 13px;">Options (Ex Green,Red,White)</label><br>
                        <textarea name="attribute_option[]" class="form-control" placeholder="Attribute option must need to separate by ,"></textarea><br>
                        <a href="javascript:void(0);" class="add_button btn btn-success" title="Add field">Add More</a>
                    </div>
                </div>


                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Add" id="submit">
                </div>

                
            </form>
        </div>

    </div>
</div>

@endsection

@section('script')

<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="form-group col-md-8" style="padding-left: 0"><label>Add Attribute</label><input type="text" name="field_name[]" class="form-control" placeholder="Title" value="" /><br><textarea name="attribute_options[]" class="form-control" placeholder="Attribute option must need to separate by ," value=""></textarea><br><a href="javascript:void(0);" class="remove_button btn btn-warning">Remove</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            //$(wrapper).append(fieldHTML); //Add field html
            $(wrapper).append('<div class="form-group col-md-8" style="padding-left: 0"><label>Add Attribute</label><br><label style="font-size: 13px;">Title (Ex Color)</label><input type="text" name="attribute_name[]" class="form-control" placeholder="Title" value="" /><br><label style="font-size: 13px;">Options (Ex Green,Red,White)</label><br><textarea name="attribute_option[]" class="form-control" placeholder="Attribute option must need to separate by ," value=""></textarea><br><a href="javascript:void(0);" class="remove_button btn btn-warning">Remove</a></div>');
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>


<script src="{{ asset('assets/admin/vendor/drug-drop-image-upload/product-image-uploader.js') }}"></script>
<script type="text/javascript">
    $('.input-images').imageUploader();

    //Save button
    $("#save_button").click(function(){
    $("#submit").click(); 
    });
</script>

@endsection
