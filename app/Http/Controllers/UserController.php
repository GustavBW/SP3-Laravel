<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    //Create user
    public function index()
    {
        abort_if( !Auth::check() || Auth::user()->access_level!=2, 403);
        return view('user.index')->with('users', User::all());
    }

    public function create()
    {
        abort_if( !Auth::check() || Auth::user()->access_level!=2, 403);
        return view('user.create');
    }

    public function show($id)
    {
        abort_if( !Auth::check() || Auth::user()->access_level!=2, 403);
        return view('user.show')->with('user', User::find($id));
    }

    public function edit($id)
    {
        abort_if(!Auth::check() || Auth::user()->access_level!=2, 403);
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
        if(!$user){
            abort(404);
        }
        $user->delete();
        return redirect()->route('home');
    }
    public function accessAdmin() {
        return view('user.admin');
    }
}
