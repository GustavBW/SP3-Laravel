@extends('master')
@section("styling")
    <link rel="stylesheet" href="{{asset('css/brew.css')}}">
@endsection
@section("body")
    <div id="content">
        <h3>Show user</h3>
        <p>User: {{$user->name}}</p><br>
        <button class="fakeBut" href="{{route('users.edit', ['id'=> $user->id])}}">Edit User</a>   
        <form action="{{route('users.destroy', ['id'=> $user->id])}}" method="POST">
            @csrf
            @method('DELETE')
            <button type= "submit" class="fakeBut"
            @if($user->id == Auth::user()->id) 
            disabled>Can't Delete
            @else
            >Delete User
            @endif     
            </button>
</form>
    </div>
@endsection
