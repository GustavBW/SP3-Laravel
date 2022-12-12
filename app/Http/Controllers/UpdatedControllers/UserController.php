<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    //Create user
    public function create()
    {
        return view('users.create');
    }

    //Store created user
    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'password' => $request->password,
        ]);

        return redirect('user');
    }
}
