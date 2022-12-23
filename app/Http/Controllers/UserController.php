<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    //Create user
    public function index()
    {
        return view('user.index')->with('users', User::all());
    }

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

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update([
            'name' => $request->input('name'),
            'password' => bcrypt($request->input('password'))
        ]);
        return redirect()->route('users', ['id' => $user->id]);
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
    public function destroy($id) {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('home');
    }
}
