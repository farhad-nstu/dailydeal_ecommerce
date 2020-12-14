<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserprofileController extends Controller
{
    public function show()
    {	
    	return view('frontend.pages.user.home');
    }
}
