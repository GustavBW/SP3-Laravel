<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    //Create user
    public function create()
    {
        return view('create');
    }

    public function show($id)
    {
        return view('user.show')->with('user', User::find($id));
    }

    public function edit($id)
    {
        return view('user.edit')->with('user',User::find($id));
    }

    //Store created user
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->input("name");
        $user->password = bcrypt($request->input("password"));
        $user->save();

        return redirect()->route('users', ['id' => $user->id]);
    }
}
