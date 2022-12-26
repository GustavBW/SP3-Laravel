@extends('master')
@section("styling")
    <link rel="stylesheet" href="{{asset('css/dash.css')}}">
@endsection

@section("body")
    <h1>Dashboard</h1>
    <div class="container">
        <div class="progress">
            <p id="Barley-text">I</p>
            <p id="Barley-full">0%</p>
            <progress min="0" value="0" max="35000" id="Barley"></progress>
        </div>

        <div class="progress">
            <p id="Hops-text">II</p>
            <p id="Hops-full">0%</p>
            <progress min="0" value="0" max="35000" id="Hops"></progress>
        </div>

        <div class="progress">
            <p id="Malt-text">III</p>
            <p id="Malt-full">0%</p>
            <progress min="0" value="0" max="35000" id="Malt"></progress>
        </div>

        <div class="progress">
            <p id="Wheat-text">IV</p>
            <p id="Wheat-full">0%</p>
            <progress min="0" value="0" max="35000" id="Wheat"></progress>
        </div>

        <div class="progress">
            <p id="Yeast-text">V</p>
            <p id="Yeast-full">0%</p>
            <progress min="0" value="0" max="35000" id="Yeast"></progress>
        </div>
    </div>
    <div>
        <p id="MaintenanceCounter-text">V</p>
        <p id="MaintenanceCounter-full">0%</p>
        <progress min="0" value="0" max="30000" id="MaintenanceCounter"></progress>
    </div>
    @include('buttons')
@endsection
@section("script")
    <script>
        document.getElementById("dashboard").classList.add("selected");
        setInterval(() => {
            inventory()
        }, 1000);
    </script>
@endsection
