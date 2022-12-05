<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class views extends Controller
{
    public function adminDash(){
        $title = "Admin dashboard";

        return view("admin/admin")->with('title', $title);
    }

    //******

    public function getCreateUser(){
        return view("admin/create")->with('title', "Create user");
    }

    public function postUser(){
        $user = new user();
        $user->name = request("name");
        $user->password = hash("sha256", request("password"));
        $user->save();
        route("admin");
    }

    //******

    public function getHome(){
        $title = "Home";

        return view("home")->with('title', $title);
    }

    public function getLogin(){
        return view("Login");
    }

    //******

    public function getPreferences(){
        $title = "preferences";

        return view("preferences")->with('title', $title);
    }

    //*******

    public function getUserList(){
        $title = "User list";

        return view("admin/userList")->with('title', $title);
    }
}
