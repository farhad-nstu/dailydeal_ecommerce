<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Slider;
use App\Banner;
use App\Category;
use App\Offer;
use App\Page;
use App\User;
use Auth;
use App\Order;
use App\Review;
use App\Transaction;
use App\Wishlist;
use App\City;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Notifications\VerifyRegistration;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\ProductImage;

class ApiController extends Controller
{
    
    public function productimage($id)
    {
        $image = ProductImage::where('product_id',$id)->get('image');
        
        //$arr = array();
        //for($i = 0; $i < count($image); $i++){
            //$images[$i]['image'] = $image[$i]; 
            //}
        
        
        return response()->json($image, 200);
    }

    //home page
    public function index() {
    	$sliders = Slider::orderBy('id', 'desc')->get();
    	$products = Product::orderBy('id', 'desc')->get();
    	$feature_products = Product::where('featured',1)->orderBy('id','desc')->paginate(40);

    	return response()->json([$sliders, $products, $feature_products], 200);
    }
    
    //slider
    public function slider() {
    	$sliders = Slider::orderBy('id', 'desc')->get();

    	return response()->json($sliders, 200);
    }
    //banner
    public function banner() {
    	$banner = Banner::orderBy('id', 'desc')->get();

    	return response()->json($banner, 200);
    }
    
    //slug
    
    public function show($slug) {
        // $products = Product::orderBy('id','desc')->paginate(4);
    	$product = Product::where('slug',$slug)->first();
    	//$image = ProductImage::where('product_id',$product->id)->get();
	    return response()->json($product, 200);
    }
    //get all product by category id
    
    public function allProductsByCategoryId($category_id) {
    $products = Product::where('category_id',$category_id)->get();
    $arr = array();
        for($i = 0; $i < count($products); $i++){
            $images = ProductImage::where('product_id', $products[$i]->id)->pluck('image');
            for($j = 0; $j < count($images); $j++){
               $products[$i]['image'] = $images[$j]; 
            }
            array_push($arr, $products[$i]);
        }
       return response()->json($arr, 200);
    }
    
    public function otpactivation(Request $request)
    {
        $request->validate([
            'otp' => 'required|min:3|max:4',
            
        ]);

        $user = User::find(Auth::user()->id);
        if (!is_null($user)) {
            if ($user->otp === $request->otp) {
               $user->status = 1;
               $user->otp = null;
               
                if($user->save()){
                    return response()->json($user, 200);
                } else {
                    return response()->json($user, 500);
                }
            }
        }
    }
    
    public function trackingSearch(Request $request)
    {
        
        $order = Order::where('tracking_id',$request->trackingid)->where('phone', $request->phone)->first();
        if (isset($order)) {
            $product_title = $order->product_title;
            $shipping_status = $order->delivery_status;
            $city = $order->city_name;
            $shipping_address = $order->shipping_address;
            $torder = array(
                'product_title'=>$product_title,
                'shipping_status'=>$shipping_status,
                'city'=>$city,
                'shipping_address'=>$shipping_address,
                );
            /*return response()->json([$product_title, $shipping_status, $city, $shipping_address], 200);*/
            return response()->json($torder, 200);
        }else {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json($returnData, 500);
        }
        
    }
    
    
    /// Category ////
    
    public function getAllCategory(){
        $allCategory = Category::all();
         return response()->json($allCategory, 200);
    }
    public function categorynewestShort($id)
    {
        $category = Category::find($id);
        $products = Product::orderBy('id','asc')->where('category_id',$id)->get();
        return response()->json($products, 200);
    }
    
    public function categorypriceasc($id)
    {
        $category = Category::find($id);
        $products = Product::orderBy('price','asc')->where('category_id',$id)->paginate(4);
        return response()->json([$products, $category], 200);
    }
    
    public function categorypricedesc($id)
    {
        $category = Category::find($id);
        $products = Product::orderBy('price','desc')->where('category_id',$id)->paginate(4);
        return response()->json([$products, $category], 200);
    }
    
    public function categoryshowamount($number,$id)
    {
        $category = Category::find($id);
        $products = Product::orderBy('id','desc')->where('category_id',$id)->paginate($number);
        return response()->json([$products, $category], 200);
    }
    
    public function categorypricShort(Request $request)
    {
        return response()->json($request->category_id, 200);
        $category = Category::find($request->category_id);
        $price = explode(',', $request->filter_price_range_input);

        $products = Product::orderBy('id','desc')->where('category_id',$category->id)->where('price','>=',$price[0])->where('price','<=',$price[1])->paginate(20);
        return response()->json([$products, $category], 200);
    }
    
    public function categorycolorShort($code, $id)
    {
        $category = Category::find($id);
        $products = Product::orWhere('attribute_options', 'like','%'.$code.'%')
        ->orderBy('id', 'desc')->where('category_id',$id)->paginate(9);
        return response()->json([$products, $category, $code], 200);
    }
    
    public function categorysizeShort($sizecode, $id)
    {
        $category = Category::find($id);
        $products = Product::orWhere('attribute_options', 'like','%'.$sizecode.'%')->where('category_id',$id)
        ->orderBy('id', 'desc')->paginate(9);
        return response()->json([$products, $category, $sizecode], 200);
    }
    
    public function categorybrandShort($brand_id, $category_id)
    {
        $category = Category::find($category_id);
        $products = Product::orderBy('id','desc')->where('category_id',$category_id)->where('brand_id',$brand_id)->paginate(9);
        return response()->json([$products, $category], 200);
    }
    
    
    
    
    /// Pages ////
    public function showPage($slug)
    {
        $page = Page::where('slug',$slug)->first();
        return response()->json($page, 200);
    }
    
    public function categorySingle($slug)
    {
        $category = Category::where('slug',$slug)->first();
        // $products = Product::orderBy('id','desc')->where('category_id',$category->id)->paginate(40);
        return response()->json( $category, 200);
    }
    
    public function brandSingle($id)
    {
        $products = Product::orderBy('id','desc')->where('brand_id',$id)->paginate(40);
        return response()->json($products, 200);
    }
    
    public function offer($slug)
    {
        $offer = Offer::where('slug',$slug)->first();
        $product_ids = $offer->product_id;
        $product_ids_array = explode(',', $product_ids);

        foreach ($product_ids_array as $product_id) {
            $products[] = Product::orderBy('id','desc')->where('id',$product_id)->first();
        }
        return response()->json([$offer, $products], 200);
    }
    
    
    //// Search /////
    public function search(Request $request) {
    	$search = $request->search;
    	if ($request->categories === Null) {
    		$products = Product::orWhere('title','like','%'.$search.'%')
	    	->orWhere('description', 'like','%'.$search.'%')
	    	->orderBy('id', 'desc')->paginate(40);
    	}
    	else {
    		$products = Product::orWhere('category_id',$request->categories)->orWhere('title','like','%'.$search.'%')
	    	->orWhere('description', 'like','%'.$search.'%')
	    	->orderBy('id', 'desc')->paginate(40);
    	}
    	return response()->json([$products, $search], 200);
    }
    
    //// Review ////
    public function createByUser(Request $request)
    {
    	$review = new Review;
    	$product_id = $request->product_id;
    	$user_email = $request->user_email;
		$product = Product::find($product_id);
		if (!is_null($product)) {
			if (!is_null($product->vendor_id)) {
				$vendor_id = $product->vendor_id;
			}
			else {
				$vendor_id = Null;
			}
		}
    	$checkduplicatereveiw = Review::orderBy('id','asc')->where('product_id', $product_id)->where('user_email', $user_email)->first();

    	if (!empty($checkduplicatereveiw)) {
    		$review = Review::find($checkduplicatereveiw->id);
			$review->product_id = $request->product_id;
			$review->vendor_id = $vendor_id;
    		$review->user_name = $request->user_name;
    		$review->user_email = $request->user_email;
    		$review->user_message = $request->user_message;
    		$review->rating = $request->rating;

    	}else {
			$review->product_id = $request->product_id;
			$review->vendor_id = $vendor_id;
    		$review->user_name = $request->user_name;
    		$review->user_email = $request->user_email;
    		$review->user_message = $request->user_message;
    		$review->rating = $request->rating;
    	}
    	
    	if($review->save()){
            return response()->json($review, 200);
        } else {
            return response()->json($review, 500);
        }
    }
    
    
    
    //// User Profile ////
    public function profileupdate(Request $request)
    {
        if(!empty($request->password)) {
    	 $request->validate([
            'name' => 'string|max:255',
            'password' => 'string|min:8|confirmed',
            'phone_number' => 'string|max:15',
            'address' => 'max:150',
            
        ]);
        }else {
            $request->validate([
            'name' => 'string|max:255',
            'phone_number' => 'string|max:15',
            'address' => 'max:150',
            
        ]);
        }

    	$user = User::find(Auth::user()->id);

    	if (!empty($request->name)) {
    		$user->name = $request->name;
    	}

    	if (!empty($request->phone_number)) {
    		$user->phone_number = $request->phone_number;
    	}

    	if (!empty($request->address)) {
    		$user->address = $request->address;
    	}

    	if (!empty($request->delivery_address)) {
    		$user->delivery_address = $request->delivery_address;
    	}

    	if (!empty($request->delivery_phone)) {
    		$user->delivery_phone = $request->delivery_phone;
    	}
    	if (!empty($request->gender)) {
    		$user->gender = $request->gender;
    	}
    	if (!empty($request->city_id)) {
    		$user->city_id = $request->city_id;
    	}
    	if (!empty($request->old_password) && !empty($request->password)) {
    		$new_password = Hash::make($request->password);
    		if (Hash::check($request->old_password, $user->password)) {
    			$user->password = $new_password;
    		}
    		else {
    			$returnData = array(
                    'status' => 'error',
                    'message' => 'An error occurred!'
                );
                return response()->json($returnData, 500);
    		}
    	}
    	
    	if($user->save()){
            return response()->json($user, 200);
        } 
    }
    
    
    
    
    
    
    
    public function checkout(Request $request)
    {
        $order = new Order;
        $order->user_id =$request->user_id;
        $order->product_id=$request->product_id;
        $order->vendor_id=$request->vendor_id;
        $order->product_title=$request->product_title;
        $order->product_image=$request->product_image;
        $order->attribute_options=$request->attribute_options;
        $order->product_quantity=$request->product_quantity;
        $order->ip_address=$request->ip_address;
        $order->carts_id=$request->carts_id;
        $order->name=$request->name;
        $order->phone=$request->phone;
        $order->email=$request->email;
        $order->city_name=$request->city_name;
        $order->shipping_address=$request->shipping_address;
        $order->message=$request->message;
        $order->amount=$request->amount;
        $order->price=$request->price;
        $order->shipping_cost=$request->shipping_cost;
        $order->status=$request->status;
        $order->currency=$request->currency;
        $order->is_completed=$request->is_completed;
        $order->payment_method=$request->payment_method;
        $order->delivery_status=$request->delivery_status;
        $order->courier_info=$request->courier_info;
        $order->tracking_id=$request->tracking_id;
        $order->transaction_id=$request->transaction_id;
        $order->save();
        
        if($order->save())
        {
            $returnData = array(
                    'status' => 'success',
                    'message' => 'Thanks for stay with us.'
                );
                return response()-> json($returnData,200);
        }
        else
        {
            $returnData = array(
                    'status' => 'failed',
                    'message' => 'Error! try again..'
                );
            return response()-> json($returnData,401);
        }
        				
    }
    
    
    
    
    
    
    public function orders($id)
    {
        /*if (Auth::check()) {*/
            $orders = Order::where('user_id',/*Auth::user()->*/$id)->get();
            return response()->json($orders,200);
        //}
    }
    
    public function orderaction($id, $action)
    {
        $order = Order::where('user_id',Auth::user()->id)->where('id', $id)->first();
        // $order = Order::where('user_id',26)->where('id', $id)->first();
        if (!is_null($order)) {
            if ($action == "Cancle") {
                $order->delivery_status = "Cancle Waiting For Confirmation";
                $order->save();
                $returnData = array(
                    'status' => 'success',
                    'message' => 'Thanks for stay with us.'
                );
                return response()->json([$order, $returnData], 200);
                
            } elseif($action == "Delivered"){
                $transaction = new Transaction;
                $transaction_id = '10'.uniqid();
                $transaction->transaction_id = $transaction_id;
                $transaction->vendor_id = $order->vendor_id;
                $transaction->product_title = $order->product_title;
                $transaction->product_quantity = $order->product_quantity;
                $transaction->payment_method = $order->payment_method;
                $transaction->product_price = $order->price;
                $comission = $order->price*(10/100);
                $transaction->comission = $comission;
                $transaction->balance = $order->price - $comission;
                $transaction->shipping_cost = $order->shipping_cost;
                $transaction->total = $order->amount;
                $transaction->status = "Waiting For Clearance";
                $transaction->withdraw = "Not Withdraw Yet";

                $transaction->save();

                $order->delivery_status = "Delivered";
                $order->save();
                $returnData = array(
                    'status' => 'success',
                    'message' => 'Thanks for stay with us.'
                );
                return response()->json([$transaction, $order, $returnData], 200);
            }
            
        }else {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occured.'
            );
            return response()->json($returnData, 200);
        }
        
    }
    
    public function ordersearch(Request $request)
    {
        if (!is_null($request->status)) {
            $orders = Order::where('status', $request->status)->where('user_id', Auth::user()->id)->paginate(9);
        }
        else {
            $orders = Order::orWhere('phone', $request->search)
            ->orWhere('tracking_id', $request->search)
            ->orWhere('name', 'like','%'.$request->search.'%')
            ->orderBy('id', 'desc')->where('user_id', Auth::user()->id)->paginate(9);
        }
        return response()->json($orders, 200);
    }
    
    /// Wishlist ///
    public function wishlistIndex()
    {
    	if (Auth::check()) {
    		$wishlists = Wishlist::where('user_id', Auth::user()->id)->paginate(10);
    	    return response()->json($wishlists, 200);
    	}
    }
    
    public function delete($id)
    {
    	if (Auth::check()) {
    		$wishlist = Wishlist::find($id);
        		$wishlist->delete();
    	}
    	$returnData = array(
            'status' => 'success',
            'message' => 'Deleted Successfully'
        );
        return response()->json($returnData, 200);
    }
    
    public function wishlistStore($id)
    {
    // 	if (!Auth::check()) {
    // 		session()->flash('success', 'Please login for add wishlist');
    // 		return redirect()->route('login');
    // 	}
    // 	else {
    		$wishlist = new Wishlist;
    		$wishlist->user_id = Auth::user()->id;
    		$wishlist->product_id = $id;
    		if($wishlist->save()){
        		$returnData = array(
                    'status' => 'success',
                    'message' => 'Added Successfully'
                );
                return response()->json([$wishlist, $returnData], 200);
            } else {
                return response()->json($wishlist, 500);
            }
    // 	}
    }
    
    ///// Register and Login ////
    public function showRegistrationForm()
    {
        $cities = City::orderBy('priority','asc')->get();
        return response()->json($cities, 200);
    }
    
    use RegistersUsers;
    
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'max:255',
            'password' => 'required|string|min:8',
            'phone_number' => 'required|string|min:11|max:14|unique:users',
        ]);

        $otp = rand(1000,9999);
        
        $user = new User;
        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        $user->otp = $otp;
        $user->address = $request->address;
        $user->delivery_phone = $request->delivery_phone;
        $user->delivery_address = $request->delivery_address;
        $user->gender = $request->gender;
        $user->city_id = $request->city_id;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->remember_token = Str::random(50);
        
        // $user->notify(new VerifyRegistration($user));
        Auth::login($user);
        
        if($user->save()){
            return response()->json([
                'message' => 'User created successfully',
                'status_code' => 201
            ], 201);
        } else {
            return response()->json([
                'message' => 'error is occured',
                'status_code' => 500
            ], 500);
        }
        // $user->save();

        // $user =  User::create([
        //     'name' => $request->name,
        //     'phone_number' => $request->phone_number,
        //     'otp' => $otp,
        //     'address' => $request->address,
        //     'delivery_phone' => $request->delivery_phone,
        //     'delivery_address' => $request->delivery_address,
        //     'gender' => $request->gender,
        //     'city_id' => $request->city_id,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'remember_token' => Str::random(50),
        // ]);


        // $user->notify(new VerifyRegistration($user));
        //return view('frontend.pages.user.home',compact('user'));
        // Auth::login($user);
        // return response()->json($user, 200);
        // return redirect()->route('user.profile.home',$user->id);
    }
    
    public function login(Request $request)
    {
        $this->validate($request, [
          'phone_number' => 'required',
          'password' => 'required',
        ]);
    
        if (Auth::guard('web')->attempt(['phone_number' => $request->phone_number, 'password' => $request->password])) {
            //, $request->remember
          // Log in Now
            return response()->json([
                'message' => 'You are logged in successfully',
                'status_code' => 201
            ], 201);
        }else {
            return response()->json([
                'message' => 'error is occured',
                'status_code' => 500
            ], 500);
        }
    }
    
    public function logout(){
       Auth::guard()->logout();
        return response()->json([
            'message' => 'You are logged out successfully',
            'status_code' => 201
        ], 201);
    }

    
    
    
    public function ordertrackingNew(){
        $newOrdertracking = Product::orderBy('id','asc')->paginate(4);
        return response()->json('$newOrdertracking', 200);
    }
    
   
    
}
