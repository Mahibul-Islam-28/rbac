<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ApiController extends Controller
{
    // login
    function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', '=', $email)->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email Not Matched.'
            ]);
        }
        if (!Hash::check($password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password not Matched.'
            ]);
        }

        $token = $user->createToken('myToken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
            'message' => 'Login Successfull!',
        ]);
    }

    // Register
    function register(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);


        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = 'user';
        $user->save();

        $token = $user->createToken('myToken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    // Logout
    function logout(Request $request)
    {
        return $request;
        $request->user()->tokens()->delete();

        return response()->json([
            'messsage' => "Tokens Deleted Succssfully."
        ]);
    }

    // check
    function check(Request $request)
    {
        return $request->user();
    }
}
