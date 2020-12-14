@php
use App\Order;
use App\Cart;
use App\Shipping;
use App\Shop;



function monthWiseSell($month)
{
	$current_year = date("Y");

	$total_sell = Order::whereMonth('created_at', '=', $month)->whereYear('created_at','=', $current_year)->where('delivery_status', "Delivered")->get();
	$total = 0;
	foreach ($total_sell as $sell) {
		$total += $sell->price;
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

{{-- <div>
  <img src="{{asset('images/dashboard.jpg')}}" style="width: 100%;">
</div> --}}

<div id="chartContainer" style="height: 370px; width: 100%;"></div>



<div class="col-md-6 pt-5">
	<label>Order Info:</label><br>
    <form action="" method="get">
	  <div class="from-group">
	    <label for="from-date">From Date</label>
	    <input type="date"  id="from-date" name="form_date">
	  </div>
	  <div class="to-group">
	    <label for="to-date">To Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
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


            <div class="table-responsive">
            <table class="table table-hover tablie-striped">

                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Details</th>
                </tr>

                @foreach($orders as $order)
                @php
                  $order_same_trx_id = Order::where('transaction_id', $order->transaction_id)->get();
                  $shipping = Shipping::find(1);
                  if ($order->city_name == "Dhaka") {
                    $shipping_cost = $shipping->inside_dhaka;
                  }else {
                    $shipping_cost = $shipping->outside_dhaka;
                  }
                @endphp
                <tr>
                  <td>
                    #
                  </td>
                  <td>
                    {{$order->name}}<br>{{$order->phone}}<br>
                          {{$order->email}}<br>
                          Shipping City{{$order->city}}<br>
                          Shipping Address: {{$order->shipping_address}} <br>
                          Transaction Id: {{$order->transaction_id}}<br>
                          Payment Status: {{$order->status}}
                  </td>
                  <td>

                    @foreach($order_same_trx_id as $single)
                    @php
                    if (!is_null($single->vendor_id)) {
                      $shop = Shop::where('vendor_id', $single->vendor_id)->first();
                    }

                    @endphp
                    <div class="card">
                      <div class="row">
                      <div class="col-12">
                        <img src="{{asset('images/order/'.$single->product_image)}}" width="50px;">
                        @if(!is_null($single->product['slug']))
                        <a href="{{route('product.show',$single->product['slug'])}}">{{$single->product_title}}</a>
                        @else
                          <a href="{{route('product.not.available')}}">{{$single->product_title}}</a>
                        @endif
                        <br>
                        Price: {{$single->price}}
                        <br>
                        Quantity: {{$single->product_quantity}}
                        <br>
                        @if(!is_null($single->attribute_options))
                        
                          @php
                            $options = unserialize($single->attribute_options);
                          @endphp
                          Attributes:
                          @foreach($options as $option)
                            {{$option}} |
                          @endforeach
                        @endif
                        <br>
                        Message: {{$single->message}}
                        <br>
                        Tracking Id: {{$single->tracking_id}}
                        <br>
                        Delivery Status: {{$single->delivery_status}}

                        <div class="dropdown">
                          <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="
                              padding: 0px 16px;
                          ">
                            Change
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{route('admin.order.update_status', ['id'=>$single->id,'action'=>'Processing'])}}">Processing</a>
                            <a class="dropdown-item" href="{{route('admin.order.update_status', ['id'=>$single->id,'action'=>'Out for Delivery'])}}">Out for Delivery</a>
                            <a class="dropdown-item" href="{{route('admin.order.update_status', ['id'=>$single->id,'action'=>'Delivered'])}}">Delivered</a>
                            <a class="dropdown-item" href="{{route('admin.order.update_status', ['id'=>$single->id,'action'=>'Cancelled'])}}">Cancelled</a>
                          </div>
                          <br>
                          <br>
                          <form action="{{route('admin.tracking.update', $single->id)}}" method="post">
                          @csrf
                          <textarea placeholder="Courier information." name="courier_info">{{$single->courier_info}}</textarea>
                          <br>
                          <button type="submit" class="btn btn-light">Save</button>
                          </form>
                        </div>
                      </div>
                      
                      </div>
                    </div>
                    
                    @endforeach

                    <div class="card">
                      Total Amount: {{$order->amount}}
                      <br>
                      Shipping Cost: {{$shipping_cost}}
                      <br>
                      Payment Method: {{$order->payment_method}}
                    </div>
                  </td>
                  
                </tr>
      
                @endforeach

            </table>
            </div>  

                
               
        </div>

    </div>
	

</div>

<form action="{{route('admin.pdf.maker', ['from'=>$from,'to'=>$to])}}" method="post">
	@csrf
	<input type="hidden" name="orders_total" value="{{$orders}}">
	<select class="form-control form-control-sm" name="download_format">
	  <option value="pdf">PDF</option>
	  <option value="xlsx">XLSX</option>
    <option value="csv">CSV</option>
    <option value="xls">XLS</option>
	</select>

	<button name="download_as_pdf">Download</button>
</form>
{{-- <button class="btn printMe">Print</button> --}}
	
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
