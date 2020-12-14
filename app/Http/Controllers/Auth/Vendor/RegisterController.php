<?php

namespace App\Http\Controllers\Auth\Vendor;

use App\Http\Controllers\Controller;
use App\Vendor;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Notifications\VerifyVendorRegistration;
use App\Notifications\VerifyRegistration;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function register(Request $request)
    {
        

        $request->validate([
            'name' => 'required|string|max:190',
            'email' => 'required|string|email|max:190|unique:vendors',
            'password' => 'required|string|min:8|confirmed',
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string',
            
        ]);


        $user =  Vendor::create([
            'name' => $request->name,
            'phone' => $request->phone_number,
            'email' => $request->email,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(50),


        ]);

        $user->notify(new VerifyVendorRegistration($user));
        //return view('frontend.pages.user.home',compact('user'));
        Auth::guard('vendor')->login($user);
        return redirect()->route('vendor.index');
    }
}
