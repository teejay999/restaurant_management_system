<?php

namespace App\Http\Controllers\Customer;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class OrderDetailController extends Controller
{
    public function displayOrderDetail(Request $request){
        $order_detail_list = DB::table('order_details')->select('order_details.quantity as quantity','menu_items.name as name','order_details.unit_price as price')
        ->join('menu_items','menu_items.id', '=', 'order_details.menu_item_id')
        ->where('order_id', $request->order_id)
        ->get();
        $order = Order::get()->where('id', $request->order_id)->first();
        return view('order_detail')->with(['order_detail_list'=> $order_detail_list, 'order'=> $order]);
    }
    public function displayAdminOrderDetails(Request $request){
        $order_detail_list = DB::table('order_details')->select('order_details.quantity as quantity','menu_items.name as name','order_details.unit_price as price')
        ->join('menu_items','menu_items.id', '=', 'order_details.menu_item_id')
        ->where('order_id', $request->order_id)
        ->get();
        $order = Order::get()->where('id', $request->order_id)->first();
        return view('order_detail_list')->with(['order_detail_list'=> $order_detail_list, 'order'=> $order]);
    }
}
