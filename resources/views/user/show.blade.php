@extends('master')
@section("styling")
    <link rel="stylesheet" href="{{asset('css/brew.css')}}">
@endsection
@section("body")
    <div id="content">
        <h3>Show user</h3>
        {{$user->name}}<br>
        <a class="fakeBut" href="{{route('users.edit', ['id'=> $user->id])}}">Edit User</a>
    </div>
@endsection
