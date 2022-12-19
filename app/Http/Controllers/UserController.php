<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    //Create user
    public function create()
    {
        return view('create')->
        with('selected', 'admin')->
        with('buttons', false)->
        with('liveData', false);
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
