@extends('master')

@section("styling")
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <link rel="stylesheet" href="{{asset('css/inventory.css')}}">
    <link rel="stylesheet" href="{{asset('css/dataStyling.css')}}">
    <link rel="stylesheet" href="{{asset('css/commands.css')}}">
    <link rel="stylesheet" href="{{asset('css/maintenance.css')}}">
    <link rel="stylesheet" href="{{asset('css/serverStatus.css')}}">
    <link rel="stylesheet" href="{{asset('css/Brewer.css')}}">
@endsection

@section("cContent")

    <div id="main">
        @include("homeExtras/ServerStatus")

        @include("homeExtras/items")

        @include("homeExtras/LiveData")

        @include("homeExtras/commands")

        @include("homeExtras/Maintenance")
    </div>
    @include("homeExtras/newBatch")
@endsection
