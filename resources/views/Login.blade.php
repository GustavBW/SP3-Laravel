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
        <form method="post" id="Login" class="center">
            <h2 class="h2">LOGIN</h2>
            <Section class="section">
                <label for="Uname" id="nameLabel">Name</label>
                <br>
                <input type="text" placeholder="Name" name="Uname" id="name" onkeyup="showName()">
            </Section>
            <section id="passwordS" class="section">
                <label for="Pword" id="passwordLabel">Password</label>
                <br>
                <input id="Password" type="password" placeholder="Password" name="Pword" onkeyup="showPass()">
            </section>
            <button id="LoginB" >Login</button>
        </form>
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
