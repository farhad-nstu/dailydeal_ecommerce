@extends('frontend.layouts.home')

@section('content')
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main">
        

        <div class="container">
            <div class="mx-xl-10">
                <div class="mb-6 text-center">
                    <h1 class="mb-6">Track your Order</h1>
                </div>
                <div class="my-4 my-xl-8">
                {{-- <form class="js-validate" novalidate="novalidate" action="{{route('tracking.search')}}" method="post"> --}}
                    @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <!-- Form Group -->
                                <div class="js-form-message form-group">
                                    <label class="form-label" for="orderid">Tracking Id
                                    </label>
                                    <input type="text" class="form-control" name="trackingid" id="trackingid" placeholder="Order Tracking ID" required>
                                </div>
                                <!-- End Form Group -->
                            </div>
                            <div class="col-md-6 mb-3">
                                <!-- Form Group -->
                                <div class="js-form-message form-group">
                                    <label class="form-label" for="billingemail">Phone Number
                                    </label>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone you used during checkout." required>
                                </div>
                                <!-- End Form Group -->
                            </div>
                            <!-- Button -->
                            <div class="col mb-1">
                                <button type="button" class="btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-4 px-lg-5 w-100 w-md-auto" id="tracking_submit">Track</button>
                            </div>
                            <!-- End Button -->
                        </div>
                    {{-- </form> --}}

                    <div id="order_info">
                        
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
<script>



    $(document).ready(function(){
        
        $('#tracking_submit').click(function(event) {
        event.preventDefault();
        var trackingid = $('#trackingid').val();
        var phone = $('#phone').val();
        var ajaxurl = "@php echo route('tracking.search'); @endphp";

        console.log(trackingid, phone);
    
    
        $.ajax(
        {   
            url: ajaxurl,   // request url
            data:{trackingid: trackingid, phone:phone} ,
            type: 'GET',
            success: function (data, status, xhr) {// success callback function
                console.log(data);
                let container = $('#order_info');

                container.append(data);
                
                // $('#cart_count').text(data.id.length);
                // console.log(data.id.length);
            },
            error: function() {
                var message = "We don't find this order" ;
                
            }
        });
    

         });

    

    });

</script>
@endsection