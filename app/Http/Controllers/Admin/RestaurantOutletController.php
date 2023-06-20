<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Session;
use App\Models\RestaurantOutlet;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Menu;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RestaurantOutletController extends Controller
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
        $restaurant_outlet_list = DB::table('restaurant_outlets as R')->select('R.*','restaurants.name as restaurant_name', 'users.name as branch_owner')
        ->join('users', 'R.user_id', '=', 'users.id')
        ->join('restaurants', 'R.restaurant_id', '=', 'restaurants.id')
        ->paginate(3);
        return view('restaurant_outlet_list')->with(array('restaurant_outlet_list'=>$restaurant_outlet_list, 'message'=>$message));
    }
    public function toAddRestaurantOutletForm(){
        $branch_owner_list = User::where('role','Branch Owner')->get();
        $restaurant_list = Restaurant::get();
        return view('add_restaurant_outlet')->with(array('branch_owner_list'=>$branch_owner_list, 'restaurant_list'=>$restaurant_list));
    }
    public function addRestaurantOutlet(Request $request){
        $restaurant_outlet = new RestaurantOutlet;
        $restaurant_outlet->name = $request->name;
        $restaurant_outlet->user_id = $request->get('branch_owner');
        $restaurant_outlet->restaurant_id = $request->get('restaurant');
        $restaurant_outlet->address = $request->address;
        $restaurant_outlet->created_by = Session::get('user_id');
        $restaurant_outlet->contact_one = $request->contact_one;
        $restaurant_outlet->contact_two = $request->contact_two;
        $restaurant_outlet->opening_time = $request->opening_time;
        $restaurant_outlet->closing_time = $request->closing_time;
        if($request->logo != NULL){
            $restaurant_outlet->logo = $request->logo->getClientOriginalName();
            $request->logo->storeAs('public/images', $request->logo->getClientOriginalName());
        }
        else{
            $restaurant = Restaurant::where('id', $request->get('restaurant'))->first();
            $restaurant_outlet->logo = $restaurant->logo;
        }
        $restaurant_outlet->save();
        return redirect('admin/restaurant_outlet_list');
    }

    public function disableRestaurantOutletRecord(Request $request){
        $restaurant = Restaurant::find($request->id);
        $paginator = Restaurant::paginate(3);
        $restaurant_outlet = RestaurantOutlet::find($request->id);
        $redirect_to_page = ($request->page <= $paginator->lastPage()) ? $request->page : $paginator->lastPage();
        $menus = Menu::select('menus.*')->where('menus.restaurant_outlet_id', $request->id)->get();
        if(count($menus)){
            return redirect()->route('admin.restaurant_outlet_list',['page'=>$redirect_to_page])->with(['message'=>"This record ".$restaurant_outlet->name." has entries associated with it. Please disable them in order to disable this record."]);
        }
        $restaurant_outlet->deleted_at = Carbon::now()->toDateTimeString();
        $restaurant_outlet->save();
        return redirect()->route('admin.restaurant_outlet_list',['page'=>$redirect_to_page]);
    }

    public function enableRestaurantOutletRecord(Request $request){
        $page = $request->page;
        $restaurant_outlet = RestaurantOutlet::withTrashed()->where('id', $request->id)->restore();
        return redirect()->route('admin.restaurant_outlet_list',['page'=>$page]);
    }

    public function toUpdateRestaurantOutlet(Request $request){
        Session::put('page',$request->page);
        $restaurant_outlet = RestaurantOutlet::find($request->id);
        $branch_owner_list = User::where('role','Branch Owner')->get();
        $restaurant_list = Restaurant::get();

        return view('update_restaurant_outlet')->with(array('restaurant_outlet'=>$restaurant_outlet, 'branch_owner_list'=>$branch_owner_list, 'restaurant_list'=>$restaurant_list));
    }

    public function updateRestaurantOutlet(Request $request){
        $page = Session::get('page');
        Session::forget('page');
        $restaurant_outlet = RestaurantOutlet::find($request->id);
        $restaurant_outlet->name = $request->name;
        $restaurant_outlet->user_id = $request->get('branch_owner');
        $restaurant_outlet->restaurant_id = $request->get('restaurant');
        $restaurant_outlet->address = $request->address;
        $restaurant_outlet->updated_by = Session::get('user_id');
        $restaurant_outlet->contact_one = $request->contact_one;
        $restaurant_outlet->contact_two = $request->contact_two;
        $restaurant_outlet->opening_time = $request->opening_time;
        $restaurant_outlet->closing_time = $request->closing_time;
        if($request->logo != NULL){
            $restaurant_outlet->logo = $request->logo->getClientOriginalName();
            $request->logo->storeAs('public/images', $request->logo->getClientOriginalName());
        }
        $restaurant_outlet->save();
        return redirect()->route('admin.restaurant_outlet_list',['page'=> $page]);
    }
}
