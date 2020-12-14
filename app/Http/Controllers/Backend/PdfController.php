<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;
use Excel;
use App\Exports\OrdersExport;
use App\Exports\UserExport;
use App\Exports\MarketingOrderExport;




class PdfController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    
    public function index(Request $request, $from, $to)
    {

    		if ($request->download_format == 'pdf') {
    			
				return Excel::download(new OrdersExport($from, $to), 'invoices.pdf');
    		}

    		if ($request->download_format == 'xlsx') {
    			
				return Excel::download(new OrdersExport($from, $to), 'invoices.xlsx');
				
    		}

    		if ($request->download_format == 'csv') {
    			
				return Excel::download(new OrdersExport($from, $to), 'invoices.csv');
				
    		}
			if ($request->download_format == 'xls') {
    			
				return Excel::download(new OrdersExport($from, $to), 'invoices.xls');
				
    		}
			
    }


    public function users(Request $request)
    {
        $json_decoded_users = json_decode($request->users,true);
        
        $ids = '';
        foreach ($json_decoded_users['data'] as $value) {
           $ids .= $value['id'].',';
        }



            if ($request->download_format == 'pdf') {
                
                return Excel::download(new UserExport($ids), 'invoices.pdf');
            }

            if ($request->download_format == 'xlsx') {
                
                return Excel::download(new UserExport($ids), 'invoices.xlsx');
                
            }

            if ($request->download_format == 'csv') {
                
                return Excel::download(new UserExport($ids), 'invoices.csv');
                
            }
            if ($request->download_format == 'xls') {
                
                return Excel::download(new UserExport($ids), 'invoices.xls');
                
            }
            
    }

    public function orders(Request $request)
    {
        $json_decoded_users = json_decode($request->users,true);
        
        $ids = '';
        foreach ($json_decoded_users['data'] as $value) {
           $ids .= $value['id'].',';
        }



            if ($request->download_format == 'pdf') {
                
                return Excel::download(new MarketingOrderExport($ids), 'invoices.pdf');
            }

            if ($request->download_format == 'xlsx') {
                
                return Excel::download(new MarketingOrderExport($ids), 'invoices.xlsx');
                
            }

            if ($request->download_format == 'csv') {
                
                return Excel::download(new MarketingOrderExport($ids), 'invoices.csv');
                
            }
            if ($request->download_format == 'xls') {
                
                return Excel::download(new MarketingOrderExport($ids), 'invoices.xls');
                
            }
            
    }
}
