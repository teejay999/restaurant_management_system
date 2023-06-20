<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(){
        if(Session::has('logged_in'))
            return redirect('admin/user_list');
        return view('welcome');
    }

    public function logOut(){
        Session::flush();
        return redirect('/admin');
    }

    public function login(Request $request){
        $query = User::where('email', $request->email)->exists();
        if(!$query)
            return view('welcome')->with(array('message'=>"User Data Not Found.", 'email'=>$request->email));
        $query = User::where('email', $request->email)->first();
        if(Hash::check($request->password, $query->password)){
            Session::put('logged_in', true);
            Session::put('email', $request->email);
            Session::put('user_name',$query->name);
            Session::put('user_id',$query->id);
            if($query->role == "Admin")
                return redirect('/admin/user_list');
            else{
                Session::flush();
                return view('welcome')->with(array('message'=>"Only Admins Can Log in the System.", 'email'=>$request->email));
            }
        }
        else
            return view('welcome')->with(array('message'=>"Password Did Not Match.", 'email'=>$request->email));
    }
}
