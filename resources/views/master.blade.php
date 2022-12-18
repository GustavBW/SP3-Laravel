<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="{{asset('css/main.css')}}">
        <link rel="stylesheet" href="{{asset('css/fonts.css')}}">
        <link rel="stylesheet" href="{{asset('css/variables.css')}}">
        @yield('styling')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <nav>
            <div>
                <p>User: Name</p>
            </div>
            <div style="text-align: center">
                <h1>BEER MACHINE</h1>
            </div>
            <div style="text-align: right">
                <ul >
                    <li><a href="{{route('home')}}" onclick="clearInterval(y); x = 0" id="dashboard">Dashboard</a></li>
                    <li><a href="{{route('brew')}}" onclick="clearInterval(y); x = 0" id="brew">Brew</a></li>
                    <li><a href="{{route('admin')}}" onclick="clearInterval(y); x = 0" id="admin">Admin</a></li>
                    <li><a href="{{route('batches')}}" onclick="clearInterval(y); x = 0" id="batches">Batches</a></li>
                    <li><a href="" onclick="clearInterval(y); x = 0" id="logout">Log out</a></li>
                </ul>
            </div>
        </nav>
        <div id="content">
            @yield("body")
        </div>
        @if($buttons === True)
            <div style="display:flex; justify-content: center; column-gap: 1vw; padding: 1vh">
                <button onclick="setCommnad('reset')">Reset</button>
                <button onclick="setCommnad('start')">Start</button>
                <button onclick="setCommnad('stop')">Stop</button>
                <button onclick="setCommnad('abort')">abort</button>
                <button onclick="setCommnad('clear')">clear</button>
            </div>
        @endif
        @if($liveData === True)
            <footer style="display:flex; column-gap: 1vw; justify-content: center; position: fixed; bottom: 1vh; width: 100vw;">
                <p>Server Status: </p>
                <p id="current_state">....</p>
            </footer>
        @endif
    </body>
    @yield('script')
    @if($liveData === True)
        <script src="{{asset('js/functions.js')}}"></script>
        <script>
            document.getElementById("{{$selected}}").classList.add("selected");
            window.onbeforeunload = () => {
                clearInterval(y)
            }
            x = 1000
            y = setInterval(async => getLiveData(z), x)
        </script>
    @endif
    @if($buttons === True)
        <script>
            function setCommnad(var1){
                fetch('/api/write/set_command/'+var1, {
                    method: 'POST',
                })

            }
        </script>
    @endif
</html>
