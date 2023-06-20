<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\RestaurantOutlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!(Session::has('logged_in'))){
            return redirect('/admin');
        }
        $message = Session::get('message');
        $id = Session::get('user_id');
        $user_list = DB::table('users')
        ->where('id','!=', $id)
        ->paginate(5);
        return view('user_list')->with(array('user_list'=>$user_list, 'message'=>$message));
    }

    public function disableUserRecord(Request $request){
        $paginator = User::paginate(5);
        $redirect_to_page = ($request->page <= $paginator->lastPage()) ? $request->page : $paginator->lastPage();
        $user = User::find($request->id);
        $restaurants = Restaurant::select('restaurants.*')->where('restaurants.user_id', $request->id)->get();
        $restaurant_outlets = RestaurantOutlet::select('restaurant_outlets.*')->where('restaurant_outlets.user_id', $request->id)->get();
        if(count($restaurants) > 0 || count($restaurant_outlets)){
            return redirect()->route('admin.user_list',['page'=>$redirect_to_page])->with(['message'=>"This record ".$user->name." has entries associated with it. Please disable them in order to disable this record."]);
        }
       
        $user->deleted_at = Carbon::now()->toDateTimeString();
        $user->save();
        return redirect()->route('admin.user_list',['page'=>$redirect_to_page]);
    }

    public function enableUserRecord(Request $request){
        $page = $request->page;
        $user = User::withTrashed()->where('id', $request->id)->restore();
        return redirect()->route('admin.user_list',['page'=>$page]);
    }

    public function toAddUserForm(Request $request){
        return view('add_user');
    }

    public function addUser(Request $request){
        if($request->password != $request->confirm_password)
            return view('add_user')->with(array('message'=>"Password and Comfirm Password Did Not Match.",'name'=>$request->name,'email'=>$request->email,'role'=>$request->get('role')));
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->get('role');
        $user->created_by = Session::get('user_id');
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('/admin/user_list');

    }

    public function updateUser(Request $request){
        $page = Session::get('page');
        Session::forget('page');
        $user = User::find($request->id);
        if($request->password != $request->confirm_password)
            return view('add_user')->with(array('message'=>"Password and Comfirm Password Did Not Match.",'name'=>$request->name,'email'=>$request->email,'role'=>$request->get('role')));
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->get('role');
        $user->updated_by = Session::get('user_id');
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('admin.user_list',['page'=>$page]);
    }

    public function toUpdateUser(Request $request){
        $user = User::find($request->id);
        Session::put('page',$request->page);
        return view('update_user')->with('user',$user);
    }    
}
