<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('css/variables.css')}}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>
<body>
    <nav class="center">
        <h1>BEER MACHINE</h1>
    </nav>

    <div id="content" class="center">
        <div>
            <h2 class="h2">LOGIN</h2>
            <form method="post" action="{{ route('doLogin') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Username</label>
                    <input class="form-control" type="text" name="name" id="name">
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="mb-3">
                    <button id="login-submit" class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        showName()
        showPass()

        function showName(){
            if(document.getElementById("name").value == ""){
                document.getElementById("nameLabel").style.opacity = "0"
            }else {
                document.getElementById("nameLabel").style.opacity = "100%"
            }
        }

        function showPass(){
            if(document.getElementById("Password").value == ""){
                document.getElementById("passwordLabel").style.opacity = "0"
            }else {
                document.getElementById("passwordLabel").style.opacity = "100%"
            }
        }
    </script>
</body>
</html>
