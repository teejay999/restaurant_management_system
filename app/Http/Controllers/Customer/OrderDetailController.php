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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderDetail $orderDetail)
    {
        //
    }
}
