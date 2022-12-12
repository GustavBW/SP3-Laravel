<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'Uname' => 'required|string',
            'Pword' => 'required|string',
        ]);

    // get username and password from request
      $username = $request->input('Uname');
      $password = $request->input('Pword');
  
    // check database for username and password
      $user = User::where('name', $username)->where('password', $password)->first();

        if ($user) {
            // if user exists, redirect to home
            return redirect()->route('home');
        } else {
            // if user does not exist, redirect to login page
            return redirect()->route('Login');
        }
    }
}
