<?php

namespace App\Http\Controllers\Customer;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('customer_log_in');
    }

    public function login(Request $request){
        $query = Customer::where('email', $request->email)->exists();
        if(!$query)
            return view('customer_log_in')->with(array('message'=>"User Data Not Found.", 'email'=>$request->email));
        $query = Customer::where('email', $request->email)->first();
        if(Hash::check($request->password, $query->password)){
            Session::put('logged_in_customer', true);
            Session::put('email', $request->email);
            Session::put('customer_name',$query->name);
            Session::put('customer_id',$query->id);
            if(Session::has('in_cart'))
                return redirect()->route('customer.to_cart');
            else if(Session::has('in_display_order'))
                return redirect()->route('customer.display_order', ['user_id'=>$query->id, 'order_status'=> "pending"]);
            return redirect()->route('customer.home');
        }
        else
            return view('customer_log_in')->with(array('message'=>"Password Did Not Match.", 'email'=>$request->email));
    }
    public function logOut(){
        Session::forget('logged_in_customer');
        Session::forget('email');
        Session::forget('customer_name');
        Session::forget('customer_id');
        return back();
    }

    public function toSignUp(){
        if(Session::has('message')){
            return view('customer_sign_up')->with(array('message'=>Session::get('message'),'customer'=>Session::get('customer')));
        }
        return view('customer_sign_up');
        
    }

    public function signUp(Request $request){
        if($request->password != $request->confirm_password)
            return redirect()->route('customer.to_sign_up')->with(array('message'=>"Password and Comfirm Password Did Not Match.",'customer'=> array('name'=>$request->name, 'email'=> $request->email)));
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = Hash::make($request->password);
        $customer->save();
        return redirect()->route('customer.to_login');
    }
}
