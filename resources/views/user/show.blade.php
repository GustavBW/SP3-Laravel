@extends('master')
@section("styling")
    <link rel="stylesheet" href="{{asset('css/brew.css')}}">
@endsection
@section("body")
    <div id="content">
        <h3>Show user</h3>
        <p>User: {{$user->name}}</p><br>
        <a class="fakeBut" href="{{route('users.edit', ['id'=> $user->id])}}">Edit User</a>
        <a class="fakeBut" href="{{route('users.destroy', ['id'=> $user->id])}}">Delete User</a>
    </div>
@endsection
