<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(
            ['name' => $request->input("name"), 'password' => $request->input("password")],
            true
        )) {
            Auth::viaRemember();
            return redirect('/');
        }else{
            return redirect()->back()->withErrors([
                'name' => 'The provided credentials do not match our records.'
            ]);
        }
    }

    public function show(){
        return view("login");
    }

    public function logout(){
        Auth::logout();

        return redirect()->route('home');

    }
}
