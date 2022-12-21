@extends('master')
@section("styling")
    <link rel="stylesheet" href="{{asset('css/brew.css')}}">
@endsection
@section("body")
    <div id="content">
        <form style="row-gap: 1vh; display: grid;" action="{{ route('users.store') }}" method="post">
            @method("put")
            @csrf
            <h1>Create User</h1>
            <label for="name">Username</label>
            <input type="text" id="name" name="name">

            <label for="password">Password</label>
            <input type="password" id="password" name="password">

            <button type="submit">Create User</button>
        </form>
    </div>
@endsection
