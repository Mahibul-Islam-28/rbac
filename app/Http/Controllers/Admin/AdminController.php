<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    function login()
    {
        return view('admin.login');
    }
    function logData(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $admin = User::where('email', '=', $email)
                        ->first();
        if (!$admin) {
            return back()->with('error', 'Email Not Matched.');
        }
        if($admin->role != 'admin' && $admin->role != 'manager')
        {
            return back()->with('error', 'Role must be Admin or Manager.');
        }
        if (!Hash::check($password, $admin->password)) {
            return back()->with('error', 'Password Not Matched.');
        }
        $request->session()->put('admin', $admin);

        return redirect(route('dashboard'))
            ->with('success','You have successfully logged in');
    }
    // signOut
    function logout(Request $request)
    {
        $request->session()->flush();
        return redirect(route('adminLogin'));
    }
}
