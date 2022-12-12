<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //Show users
    public function index()
    {
        $user = User::all();
        return view('users.index', compact('user'));
    }

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
            'email' => $request->email,
            'password' => $request->password,
            'pin' => $request->pin
        ]);

        return redirect('user');
    }

    //Show specific user
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    //Edit specific user
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    //Update specific user
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
    }

    //Delete specific user
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('user');
    }

    //Verify pin
    public function verifyPin(Request $request, $id)
    {
        // Return the result of the verification
        return User::where('id', $id)->where('pin', $request->pin)->exists();
    }

    //Verify user
    public function verifyUser(Request $request, $id, $password)
    {
        // Return the result of the verification
        return User::where('id', $id)->where('password', $password)->exists();
    }
}
