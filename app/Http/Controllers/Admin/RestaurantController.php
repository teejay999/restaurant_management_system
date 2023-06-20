<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Session;
use App\Models\Restaurant;
use App\Models\RestaurantOutlet;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class RestaurantController extends Controller
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
        $restaurant_list = DB::table('restaurants as R')->select('R.id','R.name','R.address','users.name as restaurant_owner', 'R.contact_number','R.logo','R.deleted_at')
        ->join('users', 'R.user_id', '=', 'users.id')
        ->paginate(4);
        return view('restaurant_list')->with(array('restaurant_list'=> $restaurant_list, 'message' => $message));
    }

    public function toAddRestaurantForm(){
        $restaurant_owner_list = User::where('role','Restaurant Owner')->get();
        return view('add_restaurant')->with('restaurant_owner_list',$restaurant_owner_list);
    }

    public function disableRestaurantRecord(Request $request){
        $restaurant = Restaurant::find($request->id);
        $paginator = Restaurant::paginate(4);
        $redirect_to_page = ($request->page <= $paginator->lastPage()) ? $request->page : $paginator->lastPage();
        $restaurant_outlets = RestaurantOutlet::select('restaurant_outlets.*')->where('restaurant_outlets.restaurant_id', $request->id)->get();
        if(count($restaurant_outlets)){
            return redirect()->route('admin.restaurant_list',['page'=>$redirect_to_page])->with(['message'=>"This record ".$restaurant->name." has entries associated with it. Please disable them in order to disable this record."]);
        }
        $restaurant->deleted_at = Carbon::now()->toDateTimeString();
        $restaurant->save();
        return redirect()->route('admin.restaurant_list',['page'=>$redirect_to_page]);
    }

    public function enableRestaurantRecord(Request $request){
        $redirect_to_page = $request->page;
        $restaurant = Restaurant::withTrashed()->where('id', $request->id)->restore();
        return redirect()->route('admin.restaurant_list',['page'=>$redirect_to_page]);
    }


    public function addRestaurant(Request $request){
        $restaurant = new Restaurant;
        $restaurant->name = $request->name;
        $restaurant->user_id = $request->get('restaurant_owner');
        $restaurant->address = $request->address;
        $restaurant->contact_number = $request->contact_number;
        $restaurant->created_by = Session::get('user_id');
        $restaurant->logo = $request->logo->getClientOriginalName();
        $request->logo->storeAs('public/images', $request->logo->getClientOriginalName());
        $restaurant->save();
        return redirect('/admin/restaurant_list');
    }

    public function updateRestaurant(Request $request){
        $page = Session::get('page');
        Session::forget('page');
        $restaurant = Restaurant::find($request->id);
        $restaurant->name = $request->name;
        $restaurant->user_id = $request->get('restaurant_owner');
        $restaurant->address = $request->address;
        $restaurant->contact_number = $request->contact_number;
        $restaurant->updated_by = Session::get('user_id');
        if($request->logo != NULL){
            $restaurant->logo = $request->logo->getClientOriginalName();
            $request->logo->storeAs('public/images', $request->logo->getClientOriginalName());
        }
        $restaurant->save();
        return redirect()->route('admin.restaurant_list', ['page'=> $page]);
    }

    public function toUpdateRestaurant(Request $request){
        Session::put('page',$request->page);
        $restaurant = Restaurant::find($request->id);
        $restaurant_owner_list = User::where('role','Restaurant Owner')->get();
        Session::put('logo',$restaurant->logo);
        return view('update_restaurant')->with(array('restaurant'=>$restaurant, 'restaurant_owner_list'=>$restaurant_owner_list));
    }

}
