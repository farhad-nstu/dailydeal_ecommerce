<div class="flex-center-between mb-1">
    <div class="prodcut-price col-12">
        <div class="text-gray-100" style="text-align: center;">

            @php
                $attributes = $product->attribute_options;
                if (!is_null($attributes)) {
                    # code...

                    $unserialize_attributes = unserialize($attributes);
                    $all_keys = array_keys($unserialize_attributes);
                    
                }
            @endphp
            <select class="col-12 js-select selectpicker dropdown-select ml-3"
            data-style="btn-sm bg-white font-weight-normal py-2 border">
                @if (!is_null($attributes))
                @foreach($all_keys as $key)

                @foreach($unserialize_attributes[$key] as $value)
                        @php
                            $value_as_array = explode(',', $value);
                            //print_r($value_as_array);
                        @endphp
                        @foreach($value_as_array as $option)
                            <option value="{{ $option }}">{{$option}}</option>
                        @endforeach
                        {{--  <option value="{{ $value }}">{{$value}}</option> --}}
                @endforeach
                @endforeach
                @endif


            </select>
        </div>
        
    </div>
    


    
    
</div>

<div class="flex-center-between mb-1 quantity-container">
    <!-- Quantity -->
    <div class="border rounded-pill py-2 px-3 border-color-1">
        <div class="js-quantity row align-items-center">
            <div class="col">
                <input class="js-result form-control h-auto border-0 rounded p-0 shadow-none" type="text" value="1">
            </div>
            <div class="col-auto pr-1">
                <a class="js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0" href="javascript:;">
                    <small class="fas fa-minus btn-icon__inner"></small>
                </a>
                <a class="js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0" href="javascript:;">
                    <small class="fas fa-plus btn-icon__inner"></small>
                </a>
            </div>
        </div>
    </div>
    <!-- End Quantity -->
</div>

<div class="flex-center-between mb-1 quantity-container">
    <div class="">
        <a href="#" class="btn btn-primary-dark transition-3d-hover add_to_cart_button"><i class="ec ec-add-to-cart mr-2 font-size-20"></i> Add to Cart</a>
    </div>
</div>

<style>
    .bootstrap-select {
        width: 145px;
    padding: 0;
    margin: 0 !important;
    }

    .quantity-container {
        width: 144px;
    margin: 0 auto;
    padding: 0;
    }
    .big-image .dropdown-select {
        width: 100%;
        margin-bottom: 13px !important;
    }
</style>