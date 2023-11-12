<?php

namespace App\Http\Controllers;

use App\Models\CustomerUser;
use Brian2694\Toastr\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function create()
    {
        return view('frontend.pages.customers.register');
    }
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
        ]);
        if ($validation->fails()) {
            foreach ($validation->messages()->all() as $messages) {
                toastr()->error($messages);
            }
            return redirect()->back();
        }
        CustomerUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        toastr()->success('Registration Successfully', 'Success');
        return to_route('home');

    }
    public function customerDoLogin(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:6',
        ]);
        if ($validation->fails()) {
            foreach ($validation->messages()->all() as $messages) {
                toastr()->error($messages);
            }
            return redirect()->back();
        }
        $creadentials = $request->only('email', 'password');
        $user = auth()->guard('customers')->attempt($creadentials);
        if ($user) {
            toastr()->success('Login Successfully', 'Success');
            return redirect()->route('home');
        } else {
            toastr()->error('Invalid email or password', 'Error');
            return redirect()->back();
        }
    }
    public function logout()
    {
        auth()->guard('customers')->logout();
        toastr()->success('Logout Successfully', 'Success');
        return redirect()->route('home');
    }
    public function updateProfile(Request $request)
    {
        $fileName = auth()->guard('customers')->user()->image;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = md5(time() . rand()) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/customers/'), $fileName);
        }
        auth()->guard('customers')->user()->update([
            'name' => $request->name,
            'contact' => $request->phone,
            "address" => $request->address,
            'email' => $request->email,
            'image' => $fileName,
        ]);
        return ["status" => "success", "message" => "User Updated Success fully", "data" => auth()->guard('customers')->user()];
    }
}
