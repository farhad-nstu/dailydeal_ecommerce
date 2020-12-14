@php
use App\Order;
use App\Cart;



function monthWiseSell($month)
{
	$current_year = date("Y");

	$total_sell = Order::whereMonth('created_at', '=', $month)->whereYear('created_at','=', $current_year)->where('status', 2)->get();
	$total = 0;
	foreach ($total_sell as $sell) {
		$total += $sell->total_price;
	}

	return $total;
}

if (isset($_GET['form_date'])) {
	$from = $_GET['form_date'];
	$to = $_GET['to_date'];
	$orders = Order::whereBetween('created_at', [$from, $to])->get();
}





@endphp

@extends('backend.layouts.master')

@section('content')

<?php
 
$dataPoints = array( 
	array("y" => monthWiseSell(1), "label" => "January" ),
	array("y" => monthWiseSell(2), "label" => "February" ),
	array("y" => monthWiseSell(3), "label" => "March" ),
	array("y" => monthWiseSell(4), "label" => "April" ),
	array("y" => monthWiseSell(5), "label" => "May" ),
	array("y" => monthWiseSell(6), "label" => "June" ),
	array("y" => monthWiseSell(7), "label" => "July" ),
	array("y" => monthWiseSell(8), "label" => "August" ),
	array("y" => monthWiseSell(9), "label" => "September" ),
	array("y" => monthWiseSell(10), "label" => "October" ),
	array("y" => monthWiseSell(11), "label" => "November" ),
	array("y" => monthWiseSell(12), "label" => "December" ),
);
 
?>

<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Sales"
	},
	axisY: {
		title: "Total"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## tonnes",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>



<div id="chartContainer" style="height: 370px; width: 100%;"></div>



<div class="col-md-6 pt-5">
	<label>Order Info:</label><br>
    <form action="" method="get">
	  <div class="from-group">
	    <label for="from-date">From Date</label>
	    <input type="date"  id="from-date" name="form_date">
	  </div>
	  <div class="to-group">
	    <label for="to-date">To Date</label>
	    <input type="date"  id="from-date" name="to_date">
	  </div>
	  <button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>
<br><br><br>

<div id="outprint">
@if(isset($orders))

	 <div class="card">
        <h5 class="card-header">Total orders in selected dates</h5>
        <div class="card-body">
            @include('backend.layouts.error')


            <table class="table table-hover tablie-striped">

                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Products</th>
                    <th>Total Price</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                @foreach($orders as $order)
                  @php
                  $cart_ids = unserialize($order->carts_id);
                  @endphp
                    <tr>
                        <td>#</td>
                        <td>{{$order->name}}<br>{{$order->phone}}<br>
                          {{$order->email}}<br>
                          Shipping City{{$order->city}}<br>
                          Shipping Address: {{$order->shipping_address}} <br>
                          Tracking Id: {{$order->tracking_id}}</td>
                        <td>
                        @foreach($cart_ids as $cart_id)
                        @php
                            $cart = Cart::find($cart_id);
                        @endphp

                        
                        @if(!is_null($cart))
                        <p><a href="{{route('product.show',$cart->product->slug)}}">{{$cart->product->title}}</a><br> Price {{$cart->price}}
                        @if(!is_null($cart->attribute_options))
                        Attributes 
                          
                          @php
                                $attribute_options = $cart->attribute_options;
                                $attribute_options = unserialize($attribute_options);
                            @endphp

                            @foreach($attribute_options as $option)
                                {{$option }}
                            @endforeach
                            @endif
                        </p>
                        
                        @else
                          Not Available
                        @endif
                        @endforeach

                        </td>
                        <td>{{$order->amount}}</td>
                        <td>
                          @if($order->is_paid == 0)
                            Not paid
                          @else
                            Paid
                          @endif
                        </td>
                        <td>
                          <p>
                            
                            @if($order->status == 0)
                              Processing
                            @elseif($order->status == 1)
                              Out for Delivery
                            @elseif($order->status == 2)
                              Delivered
                            @endif
                          </p>
                          <div class="dropdown">
                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="
                              padding: 0px 16px;
                          ">
                            Change
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{route('admin.order.update_status', ['id'=>$order->id,'action'=>0])}}">Processing</a>
                            <a class="dropdown-item" href="{{route('admin.order.update_status', ['id'=>$order->id,'action'=>1])}}">Out for Delivery</a>
                            <a class="dropdown-item" href="{{route('admin.order.update_status', ['id'=>$order->id,'action'=>2])}}">Delivered</a>
                          </div>
                        </div>
                        
                      </td>

                      <td>
                            <a href="#deleteModel{{ $order->id }}"  data-toggle="modal" class="btn btn-danger">Delete</a>
                        </td>
                            <!-- Modal -->
                            <div class="modal fade" id="deleteModel{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form action="{{ route('admin.order.delete', $order->id) }}" method="post">
                                  <div class="modal-body">
                                    {{ csrf_field() }}
                                    Do you like to delete permanently?
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-secondary" value="Confirm">
                                  </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                        
                    </tr>
                @endforeach

            </table>   

                
               
        </div>

    </div>

<form action="{{route('admin.pdf.maker', ['id'=>$order->id,'action'=>0])}}" method="post">
	@csrf
	<input type="hidden" name="html_content" value='
	<div id="outprint">
	@if(isset($orders))

			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

            <table class="table table-hover tablie-striped">

                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Products</th>
                    <th>Total Price</th>
                    <th>Payment</th>
                    <th>Status</th>
                </tr>

                @foreach($orders as $order)
                  @php
                  $cart_ids = unserialize($order->carts_id);
                  @endphp
                    <tr>
                        <td>#</td>
                        <td>{{$order->name}}<br>{{$order->phone}}<br>
                          {{$order->email}}<br>
                          Shipping City{{$order->city}}<br>
                          Shipping Address: {{$order->shipping_address}} <br>
                          Tracking Id: {{$order->tracking_id}}</td>
                        <td>
                        @foreach($cart_ids as $cart_id)
                        @php
                            $cart = Cart::find($cart_id);
                        @endphp

                        
                        @if(!is_null($cart))
                        <p><a href="{{route('product.show',$cart->product->slug)}}">{{$cart->product->title}}</a><br> Price {{$cart->price}}
                        @if(!is_null($cart->attribute_options))
                        Attributes 
                          
                          @php
                                $attribute_options = $cart->attribute_options;
                                $attribute_options = unserialize($attribute_options);
                            @endphp

                            @foreach($attribute_options as $option)
                                {{$option }}
                            @endforeach
                            @endif
                        </p>
                        
                        @else
                          Not Available
                        @endif
                        @endforeach

                        </td>
                        <td>{{$order->amount}}</td>
                        <td>
                          @if($order->is_paid == 0)
                            Not paid
                          @else
                            Paid
                          @endif
                        </td>
                        <td>
                          <p>
                            
                            @if($order->status == 0)
                              Processing
                            @elseif($order->status == 1)
                              Out for Delivery
                            @elseif($order->status == 2)
                              Delivered
                            @endif
                          </p>
                        
                      </td>
                        
                    </tr>
                @endforeach

            </table>   

                
               

	
@endif
</div>
	'>

<input type="hidden" name="orders_total" value="{{$orders}}">
<select class="form-control form-control-sm" name="download_format">
  <option value="pdf">PDF</option>
  <option value="xlsx">XLSX</option>
</select>

<button name="download_as_pdf">Download</button>
</form>
<button class="btn printMe">Print</button>
	
@endif
</div>




<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
          

@endsection

@section('script')
<script type="text/javascript">

$('.printMe').click(function(){
     window.print();
});

</script>
@endsection
