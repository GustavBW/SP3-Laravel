@extends('master')
@section("styling")
    <link rel="stylesheet" href="{{asset('css/dash.css')}}">
@endsection

@section("body")
    <h1>Dashboard</h1>
    <div class="container">
        <div class="progress">
            <p id="barley-text">I</p>
            <p id="barley-full">0%</p>
            <progress min="0" value="0" max="35000" id="barley"></progress>
        </div>

        <div class="progress">
            <p id="hops-text">II</p>
            <p id="hops-full">0%</p>
            <progress min="0" value="0" max="35000" id="hops"></progress>
        </div>

        <div class="progress">
            <p id="malt-text">III</p>
            <p id="malt-full">0%</p>
            <progress min="0" value="0" max="35000" id="malt"></progress>
        </div>

        <div class="progress">
            <p id="wheat-text">IV</p>
            <p id="wheat-full">0%</p>
            <progress min="0" value="0" max="35000" id="wheat"></progress>
        </div>

        <div class="progress">
            <p id="yeast-text">V</p>
            <p id="yeast-full">0%</p>
            <progress min="0" value="0" max="35000" id="yeast"></progress>
        </div>
    </div>
    <div>
        <p id="maintenance-text">V</p>
        <p id="maintenance-full">0%</p>
        <progress min="0" value="0" max="30000" id="maintenance"></progress>
    </div>
@endsection
@section("script")
    <script>
        z = "getInventory"
    </script>
@endsection