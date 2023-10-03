<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function dashboard()
    {
        $data["total_orders"] = 0;
        $data["total_customers"] = 0;
        return view('backend.restaurant.dashboard', compact('data'));
    }
    public function list()
    {
        $restaurants = Restaurant::orderBy("id", "DESC")->paginate(10);
        return view('backend.restaurant.list', compact('restaurants'));
    }
    public function approve($id)
    {
        $restaurant = Restaurant::find($id);
        $restaurant->status = "approved";
        $restaurant->save();
        toastr()->success('Restaurant approved successfully!');
        return redirect()->route('restaurant.list');
    }
    public function reject($id)
    {
        $restaurant = Restaurant::find($id);
        $restaurant->status = "rejected";
        $restaurant->save();
        toastr()->warning('Restaurant rejected successfully!');
        return redirect()->route('restaurant.list');
    }
}
