<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
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
        $foods = Restaurant::where("slug",$slug)->first()->foods()->where("status","Active")->get();
        return view("frontend.pages.restaurant-details", compact("foods"));
    }
}
