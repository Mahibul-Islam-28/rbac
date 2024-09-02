<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    function login()
    {
        return view('login');
    }
    function logData(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', '=', $email)->first();
        if (!$user) {
            return back()->with('error', 'Email Not Matched.');
        }
        if (!Hash::check($password, $user->password)) {
            return back()->with('error', 'Password Not Matched.');
        }

        $request->session()->put('user', $user);

        return redirect(route('index'))
            ->with('success','You have successfully logged in');

    }
    // Register
    function register()
    {
        return view('register');
    }
    function registerData(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:App\Models\User,email',
            'password' => 'required:min:5'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = 'user';
        $user->save();


        if($user->save())
        {
            $request->session()->put('user', $user);

            return redirect(route('index'))
            ->with('success','You have successfully registraed and login');
        }
        else{
            return back()->with('error', 'Register is unsuccessfull.');
        }
    }
    // signOut
    function logout(Request $request)
    {
        $request->session()->flush();
        return redirect(route('userLogin'));
    }
}
