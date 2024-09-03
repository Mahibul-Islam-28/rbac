<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserManageController extends Controller
{
    // Dashboard
    function dashboard()
    {
        $session = Session('admin');
        $role = $session->role;

        $users = User::all();
        if($role == 'admin')
        {
            return view('admin.dashboard')
                ->withUsers($users);
        }
        else
        {
            $permission = explode(", ", $session->permission);
            if($permission)
            {
                foreach($permission as $p)
                {
                    if($p == 'View' || $p == 'All')
                    {
                        return view('admin.dashboard')
                                ->withUsers($users);
                    }
                }

                return view('admin.dashboard')
                    ->with('error','You can not view user!');
            }
            else
            {
                return view('admin.dashboard')
                ->with('error','You can not view user!');

            }
        }
    }

    // Create
    function create()
    {
        $session = Session('admin');
        $role = $session->role;
        if($role == 'admin')
        {
            return view('admin.user.create');
        }
        else
        {
            $permission = explode(", ", $session->permission);
            if($permission)
            {
                foreach($permission as $p)
                {
                    if($p == 'Create' || $p == 'All')
                    {
                        return view('admin.user.create');
                    }
                }

                return back()
                    ->with('error','You can not create user!');
            }
            else
            {
                return back()
                ->with('error','You can not create user!');

            }
        }
    }
    function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'password' => 'required|min:5',
            'email' => 'required|email|unique:App\Models\User'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = $request->password;

        $user->save();

        if($user->save())
        {
            return redirect(route('dashboard'))
                ->with('success','You created a user!');
        }
        else
        {
            return back()
                ->with('error','You user creation failed!');
        }
    }

    // Edit
    function edit($id)
    {
        $session = Session('admin');
        $role = $session->role;
        if($role == 'admin')
        {
            $user = User::find($id);
            if($user)
            {
                return view('admin.user.edit')
                        ->withUser($user);
            }
            else
            {
                return back()
                    ->with('error', 'User Not Found.');
            }
        }
        else
        {
            $permission = explode(", ", $session->permission);
            if($permission)
            {
                foreach($permission as $p)
                {
                    if($p == 'Edit' || $p == 'All')
                    {
                        $user = User::find($id);
                        if($user)
                        {
                            return view('admin.user.edit')
                                    ->withUser($user);
                        }
                        else
                        {
                            return back()
                                ->with('error', 'User Not Found.');
                        }
                    }
                }

                return back()
                    ->with('error','You can not edit user!');
            }
            else
            {
                return back()
                ->with('error','You can not edit user!');

            }
        }

    }
    function update(Request $request, $id)
    {
        $user = User::find($id);
        if($user)
        {
            $request->validate([
                'name' => 'required',
                'role' => 'required',
                'email' => 'required|email|unique:App\Models\User,email,'.$id,
            ]);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->update();

            if($user->update())
            {
                return redirect(route('dashboard'))
                    ->with('success','You updated a User!');
            }
            else
            {
                return back()
                    ->with('error','You update has been failed!');
            }
            
        }
        else{
            return back()
                ->with('error', 'User Not Found.');
        }
    }

    // Delete
    function delete($id)
    {
        $session = Session('admin');
        $role = $session->role;
        if($role == 'admin')
        {
            return view('admin.user.create');
        }
        else
        {
            $permission = explode(", ", $session->permission);
            if($permission)
            {
                foreach($permission as $p)
                {
                    if($p == 'Delete' || $p == 'All')
                    {
                        $user = User::find($id);
                        if($user)
                        {
                            $user->delete();
                            if($user->delete())
                            {
                                return back()
                                    ->with('success', 'User delete successful.');
                            }
                            else
                            {
                                return back()
                                    ->with('success', 'User delete failed.');
                            }
                            
                        }
                        else
                        {
                            return back()
                                ->with('error', 'User Not Found.');
                        }
                    }
                }

                return back()
                    ->with('error','You can not delete user!');
            }
            else
            {
                return back()
                ->with('error','You can not delete user!');

            }
        }
    }

    // Permission
    function permission($id)
    {
        $session = Session('admin');
        $role = $session->role;
        if($role == 'admin')
        {
            $user = User::find($id);
            if($user)
            {
                if($user->role == 'user')
                {
                    return back()
                    ->with('error', 'You can not set permission for a user.');
                }
                $permission = '';
                if($user->permission != null)
                {
                    $permission = explode(", ",$user->permission);
                }
                return view('admin.user.permission')
                        ->withUser($user)
                        ->withPermission($permission);
            }
            else
            {
                return back()
                    ->with('error', 'User Not Found.');
            }
        }
        else
        {
            return back()
            ->with('error','You can set permission!');
        }

    }
    function setPermission(Request $request, $id)
    {
        $user = User::find($id);
        if($user)
        {
            $permission = $request->permission;
            $permis = '';
            
            if($permission != null)
            {
                foreach($permission as $p)
                {
                    $permis .= $p.', ';
                }
                
                $user->permission = $permis;
                $user->update();
                if($user->update())
                {
                    return redirect(route('dashboard'))
                        ->with('success','Permission has been set!');
                }
                else
                {
                    return back()
                        ->with('error','Permission set failed!');
                }
            }
            else
            {
                $user->permission = '';
                $user->update();
                return redirect(route('dashboard'))
                    ->with('success','Permission has been set!');
            }
            
        }
        else{
            return back()
                ->with('error', 'User Not Found.');
        }

    }
}
