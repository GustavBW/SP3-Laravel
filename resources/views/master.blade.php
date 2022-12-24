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
                <p>User: @if(Auth::check())
                    {{Auth::user()->name}}
                    @endif
                </p>
            </div>
            <div style="text-align: center">
                <h1>BEER MACHINE</h1>
            </div>
            <div style="text-align: right">
                <ul >
                    <li><a href="{{route('home')}}" id="dashboard">Dashboard</a></li>
                    <li><a href="{{route('brew')}}" id="brew">Brew</a></li>
                    <li><a href="{{route('admin')}}" id="admin">Admin</a></li>
                    <li><a href="{{route('batches')}}" id="batches">Batches</a></li>
                    @if(Auth::check())
                        <li><a href="{{route('logout')}}" onclick="clearInterval(y); x = 0" id="logout">Log out</a></li>
                    @else
                        <li ><a href="{{route('login')}}">Log in</a></li>
                    @endif
                </ul>
            </div>
        </nav>
        @auth
            <div id="content">
                @yield("body")
            </div>
            <div style="display:flex; justify-content: center; column-gap: 1vw; padding: 1vh" class="buts">
                <button onclick="setCommand" class="buttons">Reset</button>
                <button onclick="setCommand('start')" class="buttons">Start</button>
                <button onclick="setCommand('stop')" class="buttons">Stop</button>
                <button onclick="setCommand('abort')" class="buttons">Abort</button>
                <button onclick="setCommand('clear')" class="buttons">Clear</button>
            </div>
        @endauth
        <footer style="display:flex; column-gap: 1vw; justify-content: center; position: fixed; bottom: 1vh; width: 100vw;">
            <p>Server Status: </p>

        </footer>

    </body>
    @yield('script')
    <script>
        document.getElementById("batches").classList.add("selected");
    </script>
    <script src="{{asset('js/functions.js')}}"></script>
    <script>
        x = 1000
        y = setInterval(async => getLiveData(z), x)
        window.onunload = function() {
            clearInterval(y)
        }
        window.onbeforeunload  = function() {
            clearInterval(y)
        }
    </script>
    <script>
        function setCommand(var1){
            fetch('/api/write/set_command/'+var1, {
                method: 'POST',
            })

        }
    </script>
    @include('auth')
</html>
