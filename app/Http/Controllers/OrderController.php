<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where("restaurant_id", auth("restaurants")->user()->id)->orderBy("id", "DESC")->paginate(10);
        return view('backend.pages.orders.index', compact("orders"));
    }
    public function show($id)
    {
        $orders = OrderDetails::with("food")->where("order_id", $id)->paginate(10);
        return view('backend.pages.orders.view', compact("orders"));
    }
    public function status($id)
    {
        $order = Order::findOrFail($id);
        $order->order_status = "delivered";
        $order->save();
        toastr()->success("Order status updated successfully");
        return redirect()->back();
    }

}
