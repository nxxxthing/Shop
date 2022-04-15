<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $roles = Role::where('name', '!=', 'super-admin')->get();
        return view('admin.users.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
        ]);
            if ($request['role'] == 'admin' && !(Auth::check() && Auth::user()->hasRole('super-admin'))) {
                return redirect()->back()->with('error', 'Only Super Admin can assign other Admins!');
            }
        $user = User::create(array_merge(
            $request->except('role'),
            ['password' => bcrypt($request->password)]
        ));
        $user->save();
        $user->assignRole($request['role']);
        return redirect()->back()->with('message', 'User added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        $roles = Role::where('name', '!=', 'super-admin')->get();
        return view('admin.users.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|',
            'password' => 'required|string|min:6',
        ]);
        if ($request['email'] != $user['email']) {
            $request->validate([
                'email' => 'unique:users'
            ]);
        } elseif ($request['name'] == $user['name'] && $request['password'] == $user['password']
                                && $user->roles()->first()->name == $request['role']) {
            return redirect()->back()->with('error', 'Nothing was edited!');
        }

        if ($request['role'] != $user->roles()->first()->name) {
            if (!Auth::check() || ($request['role'] == 'admin' && !Auth::user()->hasRole('super-admin'))) {
                return redirect()->back()->with('error', 'Only Super Admin can assign other Admins!');
            }
            $user->roles()->detach();
            $user->assignRole($request['role']);
        }
        $user['name'] = $request['name'];
        $user['email'] = $request['email'];
        if ($request['password'] != $user['password']) {
            $user['password'] = bcrypt($request['password']);
        }
        $user->save();
        return redirect()->back()->with('message', 'User edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        if ($user->roles()->first()->name == 'admin' && !(Auth::check() && Auth::user()->hasRole('super-admin')))
            return redirect()->back()->with('error', 'Only super admin can delete other admins!');
        $user->delete();
        return redirect()->back()->with('message', 'User deleted successfully!');
    }
}
