<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserApiController extends Controller
{
    function get(Request $request)
    {
        if($request->user_id)
        {
            $user = User::find($request->user_id);
        
            if($user)
            {
                return $user;
            }
            else
            {
                return "User Not Found";
            }
        }
        else
        {
            return "user_id is empty.";
        }
    }
    function getAll(Request $request)
    {
        $users = User::all();
        return $users;
        
    }
    function edit(Request $request)
    {
        if(isset($request->user_id))
        {
            $user = User::find($request->user_id);
        
            if($user)
            {
                $user->name = isset($request->name) ? $request->name : $user->name;
                $user->email = isset($request->email) ? $request->email : $user->email;
                $user->update();

                return $user;
            }
            else
            {
                return "User Not Found.";
            }
        }
        else
        {
            return "user_id is empty.";
        }

    }
    function delete(Request $request)
    {
        if(isset($request->user_id))
        {
            $user = User::find($request->user_id);
        
            if($user)
            {
                $user->delete();

                return "User Has been Deleted.";
            }
            else
            {
                return "User Not Found.";
            }
        }
        else
        {
            return "user_id is empty.";
        }

    }

}
