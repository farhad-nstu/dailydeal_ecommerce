<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\VerifyRegistration;
use App\User;
use App\Brand;
use Auth;

class VerificationController extends Controller
{
    public function verify($id)
    {
    	$user = User::where('remember_token', $id)->get();

    	if (count($user) == 0) {
    		$link = route('login');
    		echo "Token don't match please try again. <a href='$link'>Login</a>" ;
    	}
    	else {
    		foreach ($user as $value) {
	    		$value->status = 1;
	    		$value->remember_token = Null;
	    		$value->email_verified_at = date('Y-m-d H:i:s');
	    		$value->save();
                if (Auth::check()) {
                    session()->flash('success','Email verified successfully.');
                    return redirect()->route('user.profile.home');
                }
                else{
	    		return redirect()->route('login');
                }

    		}

    		/*
    		$user->status = 1;
    		$user->remember_token = Null;
    		$user->email_verified_at = date('Y-m-d H:i:s');
    		$user->save();
    		return redirect()->route('login');*/

    	}
    }


    public function sendverficationemail()
    {
        $user = Auth::user();
        $user->notify(new VerifyRegistration($user));
        return back();
    }
}
