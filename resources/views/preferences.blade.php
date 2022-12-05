@extends('master')

@section("styling")
    <link rel="stylesheet" href="{{asset('css/preferences.css')}}">
@endsection

@section("content")
    <div class="main">
        <div class="head">
            <a class="back" href="{{route("home")}}">
                <h2>Back</h2>
            </a>
            <h2>Preferences</h2>
            <div>

            </div>
        </div>

        <div id="content">
            <div class="type">
                <h2>Colors</h2>
            </div>

            <div class="colorDiv">
                <h3>Main Color</h3>
                <div class="color color1"></div>
            </div>

            <div class="colorDiv">
                <h3>Secondary Color</h3>
                <div class="color color2"></div>
            </div>

            <div class="colorDiv">
                <h3>Third Color</h3>
                <div class="color color3"></div>
            </div>
        </div>
    </div>
@endsection
