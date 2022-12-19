@extends('master')
@section("body")
    <h1>Admin production Data</h1>
    <p>Recipe:</p>
    <p id="current_Recipe">1</p>

    <p>product produced:</p>
    <p id="product_produced">1</p>

    <p>product failed:</p>
    <p id="product_failed">1</p>

    <a class="fakeBut" href="{{route('create')}}">Create User</a>
@endsection
@section("script")
    <script>
        z = "getAdmin"
    </script>
@endsection
