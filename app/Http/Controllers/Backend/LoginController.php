<?php
declare (strict_types = 1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('backend.auth.login');
    }

    public function loginPost(Request $request): RedirectResponse
    {

        try {
            $user_input = $request->only('email', 'password');
            if (Auth::guard("web")->attempt($user_input)) {
                toastr()->success('Login Successful.');
                return redirect()->route('admin.dashboard');
            } else if (Auth::guard("restaurants")->attempt($user_input)) {
                toastr()->success('Login Successful.');
                return redirect()->route('restaurant.dashboard');
            }
            toastr()->error('Invalid email or password');
            return redirect()->back();
        } catch (\Throwable $exception) {
            toastr()->error($exception->getMessage());
            return redirect()->back();
        }

    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        toastr()->success('Logout Successful.');
        return redirect()->route('login');
    }
}
