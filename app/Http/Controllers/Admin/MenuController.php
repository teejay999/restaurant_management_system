<?php

namespace App\Http\Controllers\Admin;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\RestaurantOutlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(!(Session::has('logged_in'))){
            return redirect('/admin');
        }
        $restaurant_outlet_list = RestaurantOutlet::get();
        $menu_list  = DB::table('menus')->where('restaurant_outlet_id', Session::get('restaurant_outlet_id'))->paginate(4);
        $condition = !Session::has('displayMenu') && !Session::has('enableMenuRecord') && !Session::has('disableMenuRecord') && !Session::has('updateMenu') && !Session::has('addMenu');
        if(Session::has('restaurant_outlet_id') && $condition && $request->page == NULL){
            Session::forget('restaurant_outlet_id');
            $menu_list = NULL;
        }
        else if(!Session::has('restaurant_outlet_id')){
            $menu_list = NULL;
        }
        if(Session::has('enableMenuRecord')){
            Session::forget('enableMenuRecord');
        }
        else if(Session::has('disableMenuRecord')){
            Session::forget('disableMenuRecord');
        }
        else if(Session::has('updateMenu')){
            Session::forget('updateMenu');
        }
        else if(Session::has('addMenu')){
            Session::forget('addMenu');
        }
        else if(Session::has('displayMenu')){
            Session::forget('displayMenu');
        }
        if(Session::has('message')){
            $message = Session::get('message');
            Session::forget('message');
            return view('menu_list')->with(array('restaurant_outlet_list'=> $restaurant_outlet_list, 'menu_list'=> $menu_list, 'message'=>$message));       
        }
        return view('menu_list')->with(array('restaurant_outlet_list'=> $restaurant_outlet_list, 'menu_list'=> $menu_list));
    }
    
    public function displayMenu(Request $request){
    
        if($request->get('restaurant_outlet') != NULL)
            Session::put('restaurant_outlet_id',$request->get('restaurant_outlet'));
        if(Session::has('page')){
            $page = Session::get('page');
            Session::forget('page');
            return redirect()->route('admin.menu_list',['page'=>$page]);
        }
        Session::put('displayMenu',true);
        return redirect()->route('admin.menu_list',['page'=>"1"]);
    }
    public function toAddMenuForm(){
        return view('add_menu');

    }

    public function addMenu(Request $request){
        $menu = new Menu;
        $menu->name = $request->name;
        $menu->restaurant_outlet_id = Session::get('restaurant_outlet_id');
        $menu->created_by = Session::get('user_id');
        $menu->image = $request->image->getClientOriginalName();
        $request->image->storeAs('public/images', $request->image->getClientOriginalName());
        Session::put('addMenu',true);
        $menu->save();
        return redirect('/admin/display_menu');
    }

    public function disableMenuRecord(Request $request){
        Session::put('page',$request->page);
        $menu = Menu::find($request->id);
        $menu_items = MenuItem::get()->where('menu_id', $request->id);
        if(count($menu_items)){
            Session::put('message', "This record ".$menu->name." has entries associated with it. Please disable them in order to disable this record.");
            return redirect()->route('admin.display_menu');
        }
        $menu->deleted_at = Carbon::now()->toDateTimeString();
        $menu->save();
        Session::put('disableMenuRecord',true);
        return redirect('/admin/display_menu');

    }
    public function enableMenuRecord(Request $request){
        Session::put('page',$request->page);
        $menu = Menu::withTrashed()->where('id', $request->id)->restore();
        Session::put('enableMenuRecord',true);
        return redirect('/admin/display_menu');
    }

    public function toUpdateMenu(Request $request){
        Session::put('page',$request->page);
        $menu = Menu::find($request->id);
        return view('update_menu')->with('menu',$menu);
    }

    public function updateMenu(Request $request){
        $menu = Menu::find($request->id);
        $menu->name = $request->name;
        if($request->image != NULL){
            $menu->image = $request->image->getClientOriginalName();
            $request->image->storeAs('public/images', $request->image->getClientOriginalName());
        }
        $menu->save();
        Session::put('updateMenu', true);
        return redirect()->route('admin.display_menu');
    }
    public function displayMenuItems(){
        return view('menu_item_list');
    }
}
