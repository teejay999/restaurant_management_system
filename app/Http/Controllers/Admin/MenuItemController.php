<?php

namespace App\Http\Controllers\Admin;
use App\Models\MenuItem;
use App\Models\RestaurantOutlet;
use App\Models\Menu;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!(Session::has('logged_in'))){
            return redirect('/admin');
        }
        $menu_list = Menu::get()->where('restaurant_outlet_id', Session::get('restaurant_outlet_id'));
        $restaurant_outlet = RestaurantOutlet::find(Session::get('restaurant_outlet_id'));
        $menu_item_list  = DB::table('menu_items')->where('menu_id', Session::get('menu_id'))->paginate(3);
        $condition = !Session::has('displayMenuItems') && !Session::has('enableMenuItemRecord') && !Session::has('disableMenuItemRecord') && !Session::has('updateMenuItem') && !Session::has('addMenuItem');
        if(Session::has('enableMenuItemRecord')){
            Session::forget('enableMenuItemRecord');
        }
        else if(Session::has('disableMenuItemRecord')){
            Session::forget('disableMenuItemRecord');
        }
        else if(Session::has('updateMenuItem')){
            Session::forget('updateMenuItem');
        }
        else if(Session::has('addMenuItem')){
            Session::forget('addMenuItem');
        }
        else if(Session::has('displayMenuItems')){
            Session::forget('displayMenuItems');
        }
        return view('menu_item_list')->with(array('menu_list'=> $menu_list, 'menu_item_list' => $menu_item_list, 'restaurant_outlet' => $restaurant_outlet));
    }
    public function displayMenuItems(Request $request){
    
        if($request->get('menu_id') != NULL)
            Session::put('menu_id', $request->get('menu_id'));
        if(Session::has('page')){
            $page = Session::get('page');
            Session::forget('page');
            return redirect()->route('admin.menu_item_list',['page'=>$page]);
        }
        Session::put('displayMenuItems',true);
        return redirect()->route('admin.menu_item_list',['page'=>"1"]);
    }
    public function toAddMenuItemForm(){
        if(Session::has('message'))
            return view('add_menu_item')->with(array('name'=>Session::get('name'), 'price' => Session::get('price'), 'message' =>Session::get('message')));
        return view('add_menu_item');

    }
    public function addMenuItem(Request $request){
        if(!(is_numeric($request->price))){
            return redirect()->route('admin.add_menu_item_form')->with(array('name'=>$request->name, 'price' => $request->price, 'message' =>'Price filed can only contain numbers only'));
        }
        $menu_item = new MenuItem;
        $menu_item->name = $request->name;
        $menu_item->description = $request->description;
        $menu_item->menu_id = Session::get('menu_id');
        $menu_item->price = $request->price;
        $menu_item->created_by = Session::get('user_id');
        $menu_item->image = $request->image->getClientOriginalName();
        $request->image->storeAs('public/images', $request->image->getClientOriginalName());
        Session::put('addMenuItem',true);
        $menu_item->save();
        return redirect('/admin/display_menu_items');
    }
    public function toUpdateMenuItem(Request $request){
        Session::put('page',$request->page);
        $menu_item = MenuItem::find($request->id);
        return view('update_menu_item')->with('menu_item',$menu_item);
    }
    public function updateMenuItem(Request $request){
        if(!(is_numeric($request->price))){
            return view('update_menu_item')->with(array('menu_item'=> $request, 'message' =>'Price filed can only contain numbers only'));
        }
        $menu_item = MenuItem::find($request->id);
        $menu_item->name = $request->name;
        $menu_item->price = $request->price;
        $menu_item->description = $request->description;
        if($request->image != NULL){
            $menu_item->image = $request->image->getClientOriginalName();
            $request->image->storeAs('public/images', $request->image->getClientOriginalName());
        }
        $menu_item->save();
        Session::put('updateMenuItem', true);
        return redirect()->route('admin.display_menu_items');
    }
    public function disableMenuItemRecord(Request $request){
        Session::put('page',$request->page);
        $menu_item = MenuItem::find($request->id);
        $menu_item->deleted_at = Carbon::now()->toDateTimeString();
        $menu_item->save();
        Session::put('disableMenuItemRecord',true);
        return redirect('/admin/display_menu_items');

    }
    public function enableMenuItemRecord(Request $request){
        Session::put('page',$request->page);
        $menu_item = MenuItem::withTrashed()->where('id', $request->id)->restore();
        Session::put('enableMenuItemRecord',true);
        return redirect('/admin/display_menu_items');
    }
}
