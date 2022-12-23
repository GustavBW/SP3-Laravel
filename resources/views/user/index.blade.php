@extends('master')
@section("styling")
    <link rel="stylesheet" href="{{asset('css/batches.css')}}">
@endsection

@section("body")
    <h1>Users</h1>
    <div class="items">
        @foreach ($users as $user)
            <div class="item">
                <h3>User</h3>
                <a href="{{route('users', ['id' => $user->id])}}">id: {{ $user->id }}</a>
            </div>
        @endforeach
    </div>
@endsection
