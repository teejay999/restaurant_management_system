<?php

namespace App\Http\Controllers\Customer;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Helpers\CartItem;
use App\Models\MenuItem;
use App\Models\Menu;
use App\Models\RestaurantOutlet;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class OrderController extends Controller
{
    
    public function index(Request $request)
    {
        $restaurant_outlet = RestaurantOutlet::get()->where('name','Gourmet DHA')->first();
        $menu_list = Menu::where('restaurant_outlet_id',$restaurant_outlet->id)->orderBy('name')->get();
        return view('home')->with(array('menu_list'=> $menu_list));
    }
    public function updateStatus(Request $request){
        $order_status_array = [];
        if($request->selected_order_status != "pending")
            $order_status_array[] = "pending" ;
        if ($request->selected_order_status != "accepted")
            $order_status_array[] = "accepted" ;
        if ($request->selected_order_status != "delivered")
            $order_status_array[] = "delivered" ;
        if ($request->selected_order_status != "rejected")
            $order_status_array[] = "rejected" ;
        Order::where('id', $request->order_id)->update(['status'=> $request->order_status]);
        return redirect()->route('admin.order',$request->selected_order_status);
    }
    public function displayAdminOrders(Request $request){
        $order_status_array = [];
        $selected_order_status = $request->order_status ;
        $order_list = DB::table('orders')->select('orders.*', 'customers.name as name', 'customers.email as email', 
        'restaurant_outlets.name as restaurant_outlet_name','restaurants.name as restaurant_name')
        ->join('customers', 'customers.id', '=', 'orders.customer_id')
        ->join('restaurant_outlets', 'restaurant_outlets.id', '=', 'orders.restaurant_outlet_id')
        ->join('restaurants', 'restaurant_outlets.restaurant_id', '=', 'restaurants.id')
        ->where('status', $selected_order_status)
        ->orderBy('orders.created_at', 'DESC')->paginate(5);
        if($selected_order_status != "pending")
            $order_status_array[] = "pending" ;
        if ($selected_order_status != "accepted")
            $order_status_array[] = "accepted" ;
        if ($selected_order_status != "delivered")
            $order_status_array[] = "delivered" ;
        if ($selected_order_status != "rejected")
            $order_status_array[] = "rejected" ;
        $color = ($selected_order_status == "pending" ? "red" : ($selected_order_status == "accepted" ? "orange" : ($selected_order_status == "delivered" ? "green" : ($selected_order_status == "rejected" ? "grey" : ""))));
        return view('order_list')->with(array('order_list'=> $order_list, 'selected_order_status'=>$selected_order_status, 'order_status_array'=>$order_status_array, 'color' => $color));
    }

    public function addItemToCart(Request $request){
        $menu_item = MenuItem::find($request->menu_item_id);
        return response()->json(['menu_item'=> $menu_item]);
    }

    public function displayCart(){
        $menu_item_list = MenuItem::get();
        return response()->json(['menu_item_list'=>$menu_item_list]);
    }

    public function toCart(Request $request){
        Session::put('in_cart', true);
        return view('cart');
    }

    public function incrementQuantity(Request $request){
        $cart = Session::get('cart_data_item');
        $cart++;
        Session::put('cart_data_item',$cart);
        $menu_item = MenuItem::find($request->menu_item_id);
        Session::get($menu_item->name)->incrementQuantity();
    }

    public function checkOut(Request $request){
        Session::put('total_price', $request->total_price);
        return view('check_out');
    }

    public function displayOrder(Request $request){
        $restaurant_outlet = RestaurantOutlet::get()->where('name','Gourmet DHA')->first();
        if(Session::has('in_cart'))
            Session::forget('in_cart');
        Session::put('in_display_order', true);
        $selected_order_status = $request->order_status ;
        $order_list = DB::table('orders')->select('orders.*')
        ->where('customer_id', $request->user_id)->where('restaurant_outlet_id', $restaurant_outlet->id)
        ->where('status', $selected_order_status)->orderBy('created_at', 'DESC')->paginate(5);
        $order_status_array = [];
        if($selected_order_status != "pending")
            $order_status_array[] = "pending" ;
        if ($selected_order_status != "accepted")
            $order_status_array[] = "accepted" ;
        if ($selected_order_status != "delivered")
            $order_status_array[] = "delivered" ;
        if ($selected_order_status != "rejected")
            $order_status_array[] = "rejected" ;
        $color = ($selected_order_status == "pending" ? "red" : ($selected_order_status == "accepted" ? "orange" : ($selected_order_status == "delivered" ? "green" : ($selected_order_status == "rejected" ? "grey" : ""))));
        return view('order')->with(array('order_list'=> $order_list, 'selected_order_status'=>$selected_order_status, 'order_status_array'=>$order_status_array, 'color' => $color));
    }

    public function placeOrder(Request $request){
        $cart_data = json_decode($request->cart_data,true);
        $menu_item_list = MenuItem::get();
        $order = new Order;
        $order->date = now();
        $order->address = $request->address;
        $order->total_price = $request->total_price;
        $order->customer_id =  Session::get('customer_id');
        $order->restaurant_outlet_id =  '1';
        $order->created_by =  Session::get('customer_id');
        $order->status = "pending";
        $order->save();
        $order = Order::get()->where('customer_id',Session::get('customer_id'))->last();
        $size = sizeof($cart_data);
        foreach($menu_item_list as $menu_item){
            for($i = 0; $i < $size; $i++){
                if($cart_data[$i]['name'] == $menu_item->name){
                    $order_detail = new OrderDetail;
                    $order_detail->menu_item_id = $menu_item->id;
                    $order_detail->order_id = $order->id;
                    $order_detail->quantity = $cart_data[$i]['quantity'];
                    $order_detail->unit_price = $menu_item->price;
                    $order_detail->created_by =  Session::get('customer_id');
                    $order_detail->save();
                    break;    
                }
            }
        }
        return view('order_confirmation');
    }


    public function displayMenuItems(Request $request){
        $menu_item_list = MenuItem::get()->where('menu_id', $request->menu_id)->where('deleted_at', NULL);
        return response()->json(['menu_item_list'=>$menu_item_list]);
    }
}
