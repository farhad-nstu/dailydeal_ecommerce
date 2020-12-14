<?php

namespace App\Exports;

use App\Order;
use App\Cart;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromQuery, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    function __construct($from, $to) {
    $this->from = $from;
    $this->to = $to;
  	} 

    public function query()
    {
        return Order::whereBetween('created_at', [$this->from, $this->to]);
    }

    public function map($order): array
    {	


        return [
            $order->name,
            $order->phone,
            $order->shipping_address,
            $order->delivery_status,
            $order->product_title,
            $order->product_quantity,
            $order->shipping_cost,
            $order->price
            

        ];
    }


     public function headings(): array
    {
        return [
            'User Name',
            'Phone Number',
            'Shipping Address',
            'Status',
            'Product Name',
            'Quantity',
            'Shipping Cost',
            'Price'
        ];
    }
}
