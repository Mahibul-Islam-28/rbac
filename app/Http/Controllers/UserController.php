<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    function index()
    {
        $session = Session('user');
        $id = $session->id;

        $user = User::find($id);

        return view('index')
                ->withUser($user);
    }
}
