@extends('master')
@section("styling")
    <link rel="stylesheet" href="{{asset('css/brew.css')}}">
@endsection
@section("body")
    <div id="content">
        <form style="row-gap: 1vh; display: grid;" action="" method="post">
            <h1>Create User</h1>
            <label for="name">Username</label>
            <input type="text" id="name">
            <label for="password">Password</label>
            <input type="text" id="password">
            <button onmouseup="">Create User</button>
        </form>
    </div>
@endsection
