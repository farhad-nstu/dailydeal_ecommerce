<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SmsController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function single(Request $request)
    {

    	$request->validate([
            'phone_number' => 'required|string|min:11|max:14',
            
        ]);

        $url = "http://66.45.237.70/api.php";
        $number=$request->phone_number;
        $text= $request->sms;
        $data= array(
        'username'=>"dailydealbd",
        'password'=>"UTGKNZ85",
        'number'=>"$number",
        'message'=>"$text"
        );

        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);
        $p = explode("|",$smsresult);
        $sendstatus = $p[0];

        session()->flash('success', 'Send successfully');
    	return back();

    }

    public function bulk(Request $request)
    {

    	$request->validate([
            'sms' => 'required',
            'phone_number' => 'required',
            
        ]);

    	


        $url = "http://66.45.237.70/api.php";		
        $number=$request->phone_number;
        $text= $request->sms;
        $data= array(
        'username'=>"dailydealbd",
        'password'=>"UTGKNZ85",
        'number'=>"$number",
        'message'=>"$text"
        );

        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);
        $p = explode("|",$smsresult);
        $sendstatus = $p[0];

        session()->flash('success', 'Send successfully');
    	return back();

    }

}
