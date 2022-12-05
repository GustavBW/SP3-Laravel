@extends('def')

@section('head')
    <title>{{$title}}</title>
    <link rel="stylesheet" href="{{asset('css/navBar.css')}}">
    @yield('styling')
@endsection

@section('body')
    <nav id="navBar" class="border">
        <div class="height"></div>
        <div class="height">
            <a href="{{route('home')}}">
                <h1 class="fontText logo" >BEER MACHINE</h1>
            </a>
        </div>
        <div class="height settings" onmouseleave="f()">
            <img src="{{asset("imgs/settingIcon.png")}}" class="settingIcon" onmouseup="f('pressed')">
            <div class="settingBar" id="settingBar">
                <a href="{{route("preference")}}"><h2 class="settingH2">SETTINGS</h2></a>
                <a href="{{route("admin")}}"><h2 class="settingH2">ADMIN</h2></a>
                <a><h2 class="settingH2">LOG OUT</h2></a>
            </div>
        </div>
    </nav>
    @yield('cContent')
    <script>
        let nav = false
        let pressed = false

        function f(state){
            if(state == 'pressed' && !nav){
                pressed = true
                document.getElementById("settingBar").classList.add("down")
                nav = true
                return
            }else if (state == 'pressed' || nav){
                document.getElementById("settingBar").classList.remove("down")
                nav = false
                pressed = false
            }
        }
    </script>
@endsection
