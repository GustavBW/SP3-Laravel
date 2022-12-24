@extends('master')
@section("styling")
    <link rel="stylesheet" href="{{asset('css/brew.css')}}">
@endsection
@section("body")
    <div id="content">
        <form style="row-gap: 1vh; display: grid;" action="{{ route('users.update', ['id'=> $user->id]) }}" method="post">
            @csrf
            <h1>Update User</h1>
            <label for="name">Username</label>
            <input type="text" id="name" name="name" value="{{$user->name}}">

            <label for="password">Password</label>
            <input type="password" id="password" name="password" value="{{$user->password}}">
            <select id="selected">
                <option value="0">User type</option>
                <option value="1">user</option>
                <option value="2">admin</option>
            </select>
            <button type="submit">Update</button>
        </form>
    </div>
@endsection
