<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy("id", "DESC")->paginate(10);
        return view('backend.pages.orders.index');
    }
}
