<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::where('status', 'approved')->select(DB::raw('*, null as  password'))->get();

        return view('frontend.pages.home', compact("restaurants"));
    }
    public function restaurantDetails(string $slug)
    {
        $foods = Restaurant::where("slug", $slug)
            ->where("status", "approved")
            ->first()?->foods;

        return view("frontend.pages.restaurant-details", compact("foods"));
    }
    public function foodDetails(Request $request){
        
        $food = Food::where("id", $request->food_id)->first();
        $view = view("frontend.components.food-modal", compact("food"))->render();
        return $view;
    }
}
