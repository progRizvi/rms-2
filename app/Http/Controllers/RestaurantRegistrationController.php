<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RestaurantRegistrationController extends Controller
{
    public function registration()
    {
        return view('backend.auth.restaurant-registration');
    }
    public function doRegistration(Request $request)
    {

        $validation = Validator::make($request->all(), [
            "username" => "required|unique:restaurants,username",
            "email" => "required|email|unique:restaurants,email",
            "password" => "required|min:6",
            "restaurant_name" => "required",
        ]);
        if ($validation->fails()) {
            foreach ($validation->errors()->all() as $error) {
                toastr()->error($error);
            }
            return redirect()->back();
        }
        try {
            $data = $request->except("_token", "password");
            $data["password"] = bcrypt($request->password);
            $data["status"] = "inactive";
            $data["type"] = "restaurant";
            $data["slug"] = strtolower(str_replace(" ", "-", $request->restaurant_name));
            $data["image"] = "default.png";
            $restaurant = Restaurant::create($data);
            if ($restaurant) {
                toastr()->success("Registration Successful. Please wait for admin approval.");
                return redirect()->route('login');
            }
            toastr()->error("Registration Failed.");
            return redirect()->back();

        } catch (\Throwable $exception) {
            toastr()->error($exception->getMessage());
            return redirect()->back();
        }
    }
}
