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
                        <li><a href="{{route('logout')}}" id="logout">Log out</a></li>
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
        @endauth
        <footer style="display:flex; column-gap: 1vw; justify-content: center; position: fixed; bottom: 1vh; width: 100vw;">
            <p>Server Status: </p>
            <p id="CurrentState">ikke talt</p>
        </footer>

    </body>
    @yield('script')
    <script src="{{asset('js/functions.js')}}"></script>
    <script>
        setInterval(serverStatus, 1000)
    </script>
</html>
