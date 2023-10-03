<?php

namespace App\Http\Controllers;

class RestaurantController extends Controller
{
    public function dashboard()
    {
        $data["total_orders"] = 0;
        $data["total_customers"] = 0;
        return view('backend.restaurant.dashboard', compact('data'));
    }
}
