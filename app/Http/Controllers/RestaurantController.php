<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Restaurant;
use Illuminate\Http\Request;

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
    public function profile()
    {
        return view('backend.restaurant.profile');
    }
    public function bookings()
    {
        $bookings = Booking::where("restaurant_id", auth("restaurants")->user()->id)->orderBy("id", "DESC")->paginate(10);
        return view("backend.pages.bookings.index", compact("bookings"));
    }
    public function status($id)
    {
        $booking = Booking::find($id);

        if ($booking->status == "pending") {
            $booking->status = "confirm";
            $booking->save();
            toastr()->success("Booking confirm successfully");
            return redirect()->back();
        } else {
            $booking->status = "complete";
            $booking->save();
            toastr()->success("Booking pending successfully");
            return redirect()->back();
        }
    }
    public function assignTable(Request $request)
    {
        dd($request->all());
    }
}
