<?php
declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\User;
use App\Exports\UsersExport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Domain_config;
use App\Models\Membership;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class UserController extends Controller
{
    public function list()
    {
        $search = request()->query('search');
        if ($search) {
            $users = User::withTrashed()->orderBy('id', 'desc')
                ->whereLike(['name', 'email', 'phone','role.name'], $search)->paginate(10);
            return view('backend.user.user_list', compact('users'));
        }
        $users = User::orderBy('id', 'desc')->withTrashed()->paginate(10);

        return view('backend.user.user_list', compact('users'));
    }

    public function view($id)
    {
        $user = User::find($id);
        return view('backend.user.view', compact('user'));

    }

    public function create()
    {
        $roles = Role::where('id', '!=', '1')->get();

        return view('backend.user.create', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'password' => 'required',
            'role_id' => 'required|unique:roles,name',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        try {

            $filename = '';
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = date('Ymdhis') . '.' . $file->getClientOriginalExtension();
                $file->storeAs('/users', $filename);
            }
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id' => $request->role_id,
                'phone' => $request->phone,
                'image' => $filename,
            ]);
            toastr()->success('user created.');
            return redirect()->route('user.list');
        } catch (Throwable $th) {
            toastr()->error($th->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        if ($user->role_id != 1) {
            return view('backend.user.edit', compact('user'));
        } else {
            toastr()->error('You can not edit super admin.');
            return redirect()->back();
        }

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        try {
            $user = User::find($id);
            if (!$user) {
                toastr()->warning('Data not found');
                return redirect()->back();
            }
            if ($user->role != 'super_admin') {

                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $filename = date('Ymdhis') . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('/users', $filename);
                    $user['image'] = $filename;
                }

                if ($user) {
                    $user->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                    ]);

                    toastr()->success('user updated...');
                    return redirect()->route('user.list');

                } else {
                    toastr()->error('You can not edit super admin.');
                    return redirect()->back();
                }
            }

        } catch (Throwable $th) {
            toastr()->error($th->getMessage());
            return redirect()->back();
        }
    }

    public function block($id): RedirectResponse
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            toastr()->success('User blocked');
            return redirect()->back();
        } else {
            toastr()->error('User not found.');
            return redirect()->back();
        }
    }

    public function unblock($id): RedirectResponse
    {
        $user = User::withTrashed()->find($id);
        if ($user) {
            $user->restore();
            toastr()->success('user restored');
            return redirect()->back();
        } else {
            toastr()->error('user not found');
            return redirect()->back();
        }
    }

}
