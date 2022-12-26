@extends('master')
@section("body")
    <h1>Admin production Data</h1>
    <p>BatchID:</p>
    <p id="BatchId">ikke talt</p>

    <p>Recipe:</p>
    <p id="CurrentRecipe">ikke talt</p>

    <p>product produced:</p>
    <p id="ProductsProduced">ikke talt</p>

    <p>product failed:</p>
    <p id="ProductsFailed">ikke talt</p>
    
    @if(Auth::user())
    @if(Auth::user()->access_level == 2)
    <br>
    Only for admins
    <br><br>
    <a class="fakeBut" href="{{route('create')}}">Create User</a> <br><br>
    <a class="fakeBut" href="{{route('users.index')}}">Show users</a>
    @endif
    @endif
    @include('buttons')
@endsection
@section("script")
    <script>
        document.getElementById("admin").classList.add("selected");
        setInterval(() => {
            adminStats();
        }, 1000);
    </script>
@endsection
