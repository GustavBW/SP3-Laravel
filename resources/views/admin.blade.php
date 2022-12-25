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

    auth for users with acess lvl 2
    <a class="fakeBut" href="{{route('create')}}">Create User</a>
    <a class="fakeBut" href="{{route('users.index')}}">show users</a>
    @include('buttons')
@endsection
@section("script")
    <script>
        setInterval(() => {
            adminStats();
        }, 1000);
    </script>
@endsection