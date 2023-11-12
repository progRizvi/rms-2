<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserBookingController extends Controller
{
    public function booking(Request $request)
    {
        $restaurant = Restaurant::where("slug", $request->slug)->first();
        if (!$restaurant) {
            toastr()->error("Restaurant not found");
            return redirect()->back();
        }
        $request->validate([
            "name" => "required",
            "phone" => "required",
            "date_time" => "required|after_or_equal:now",
            "persons" => "required",
        ]);
        $booking = Booking::create([
            "user_id" => auth("customers")->user()->id,
            "restaurant_id" => $restaurant->id,
            "name" => $request->name,
            "phone" => $request->phone,
            "date_time" => Carbon::parse($request->date_time)->format("Y-m-d H:i:s"),
            "persons" => $request->persons,
            "message" => $request->message,
        ]);
        if ($booking) {
            toastr()->success("Table Booked successfully");
            return redirect()->back();
        } else {
            toastr()->error("Booking creation failed");
            return redirect()->back();
        }
    }
}
